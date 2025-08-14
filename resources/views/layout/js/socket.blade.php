<script>
    let socket;
    let isOnline = @json(env('ONLINE'));
    let devMode = @json(env('DEV_MODE'));

    let socketHostDev = isOnline === false ? @json(env('SOCKET_HOST_DEV_BACK')) : @json(env('SOCKET_HOST_DEV_FRONT'));
    let socketHostLive = isOnline === false ? @json(env('SOCKET_HOST_LIVE_BACK')) : @json(env('SOCKET_HOST_LIVE_FRONT'));
    let socketPort = isOnline === false ? @json(env('SOCKET_PORT_BACK')) : @json(env('SOCKET_PORT_FRONT'));

    let socketHost = devMode === true ? socketHostDev : socketHostLive;
    let employeeid_session = "{{ session('user')->employee_id }}"
    let emp_img_url_socket = "{{ env('EMP_IMG_URL') }}";

    let socketUrl;

    if (isOnline) {
        socketUrl = `http://${socketHost}`; 
    } else {
        socketUrl = `http://${socketHost}:${socketPort}`;
    }

    socket = io(socketUrl, {
        @if (env('ONLINE'))
            path: "/dirssocket/socket.io",
        @endif
        query: {
            employee_id: employeeid_session,
        }
    });

    socket.on('connect', () => {
        console.log('Successfully Connected To Incident Record Websocket Server.');
    });

    function socketConnection(connectionName, callback = null) {
        socket.on(connectionName, (msg) => {
            if (typeof callback === "function") {
                callback(msg);
            }
        });
    }

    function sendSocket(connectionName, obj, callback = null) {
        try {
            socket.emit(connectionName, obj);
            if (typeof callback === "function") {
                callback();
            }
        } catch (error) {
            console.error("Socket send error:", error);
        }
    }


    function NotificationSound() {
        const audio = new Audio("{{ asset('assets/sounds/notification.mp3') }}");
        audio.play().catch((error) => {
            console.error("Error playing sound:", error);
        });
    }

    $(document).ready(function() {
        socketConnection("incident_report", (notif) => {
            if (Array.isArray(notif)) {
                let notif_for_me = notif.find(x => x.receiver == employeeid_session);
                if (notif_for_me) {
                    swalAlertNotif(notif_for_me);
                }
            } else {
                if (notif.receiver == employeeid_session) {
                    swalAlertNotif(notif);
                }
            }
        })
    })

    function swalAlertNotif(data) {
        const imageUrl = `${emp_img_url_socket}/${data.employee_number}.png?quality=50&width=30&height=30`;
        const defaultImageUrl = `{{ asset('assets/images/default.png') }}`;
        let redirect_url = `{{ route('incident_report.viewincidentreport') }}?A9fKz1LQc=${data.item_id}`;

        let notifToast = `
            <div class="toast show glass-card text-white" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="false">
                <div class="toast-header glass-card" style="border-bottom: 1px solid #c3c3c3;">
                    <img src="{{ asset('assets/images/incidentreport/notification_bell2.png') }}"
                        class="toast-icon rounded me-2" alt="Notification">
                    <strong class="me-auto text-white">New Notification</strong>
                    <small class="text-white fs-1 datetime-update" data-date="${data.created_at}">Just now</small>
                    <button type="button" class="p-0 px-1 ms-1 close-btn" data-bs-dismiss="toast" aria-label="Close">
                        <i class="bi bi-x-lg text-white"></i>
                    </button>
                </div>
                <div class="toast-body glass-card">
                    <div class="d-flex gap-1 align-items-center">
                        <div class="profile-avatar">
                            <img src="${imageUrl}" class="rounded-circle w-100 h-100 object-fit-cover" onerror="this.src='${defaultImageUrl}';">
                        </div>
                        <div>
                            <p class="mb-0 fs-2 toast-username text-capitalize">${data.fullname ? data.fullname.toLowerCase() : ''}</p>
                            <p class="mb-0 fs-2 toast-role text-capitalize">${data.Position ? data.Position.toLowerCase() : ''}</p>
                        </div>
                    </div>

                    <div class="mt-3 glass-card2 p-2 rounded">
                        <p class="mb-0 fs-2 toast-message">
                            <i class="bi bi-app-indicator me-1"></i>
                            ${data.description}
                        </p>
                    </div>
                    <div class="mt-3 row px-3">
                        <div class="col-6 ps-0">
                            <a href="${redirect_url}" class="btn w-100 glass-card3 text-white btn-notif-hover" style="font-size: 11px; letter-spacing: 1px">
                                View
                            </a>
                        </div>
                        <div class="col-6 pe-0">
                           <button data-bs-dismiss="toast" aria-label="Close" class="btn w-100 glass-card3 text-white btn-notif-hover" style="font-size: 11px; letter-spacing: 1px">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $("#toast-container-global").prepend(notifToast);
        setInterval(updateTimeAgoBaseOnClass, 5000);
    }
</script>
