<script>
    let notificationData = [];
    let emp_img_url_notif = "{{ env('EMP_IMG_URL') }}";

    $(document).on("click", "#dropnotif", function() {
        postRequest("{{ route('global.getNotificationList') }}", {}, (response) => {
            if (response.status == "success") {
                notificationData = response.data;
                getNotificationCount();
                populateNotification(notificationData);
            }
        })
    });

    function populateNotification(data) {
        skeletonNotif();
        let emptyMessage = `
            <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column py-3"
                id="empty_attachment">
                <img src="{{ asset('assets/images/emptysearch.png') }}" style="width: 130px; height: 130px">
                <p class="mb-0 text-center" style="font-size: 15px; letter-spacing: 1px;">No Notification</p>
            </div>
        `;
        let notificationHTML = data.map(x => {
            const imageUrl = `${emp_img_url_notif}/${x.employee_number}.png?quality=50&width=30&height=30`;
            const defaultImageUrl = `{{ asset('assets/images/default.png') }}`;
            return `
                <div class="d-flex gap-2 hover-notification align-item-center px-3 pt-1 pb-1 position-relative notif-redirect" data-notif_id='${x.notif_id}' data-is_read='${x.is_read}' data-item_id='${x.item_id}' data-notif_type='${x.notif_type}'>
                    <div style="width: 55px; height: 55px; flex-shrink: 0" class="border rounded-circle overflow-hidden">
                        <img src="${imageUrl}" class="w-100 h-100 object-fit-cover" onerror="this.src='${defaultImageUrl}';">
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        <p class="mb-0 fw-semibold text-capitalize" style="font-size: 13px">${x.sender.toLowerCase()}</p>
                        <p class="mb-0 text-wrap" style="font-size: 11px;">${x.description}</p>
                        <p class="mb-0" style="font-size: 9px">${formatDateToStr(x.created_at)}</p>
                    </div>
                    ${
                        x.is_read == 0 ? `
                            <div class="notif-dot-notread bg-primary"></div>
                        ` : ``
                    }
                </div>
            `;
        }).join('');

        if (data.length == 0) {
            notificationHTML = emptyMessage;
        }

        setTimeout(() => {
            $("#notificationDiv").html(notificationHTML);
        }, 800);
    }

    function getNotificationCount() {
        postRequest("{{ route('global.getNotificationCount') }}", {}, (response) => {
            if (response.status == 'success') {
                let count = response.count;
                if (count > 0) {
                    $("#notif_dot, #notification_count").removeClass("d-none");
                    $("#notification_count").text(`${count} new`);
                }
            }
        })
    }

    function haveNotification() {
        postRequest("{{ route('global.haveNotification') }}", {}, (response) => {
            if (response.status == 'success') {
                let haveNotification = response.haveNotification;
                if (haveNotification) {
                    $("#notif_dot, #notification_count").removeClass("d-none");
                }
            }
        })
    }

    $(document).ready(function() {
        haveNotification();
    })

    $(document).on("click", ".notif-redirect", function(e) {
        e.stopPropagation();
        e.preventDefault();
        console.log("hello");
        let is_read = $(this).data('is_read');
        let item_id = $(this).data('item_id');
        let notif_id = $(this).data('notif_id');
        let notif_type = $(this).data('notif_type');
        let redirect_url = `{{ route('incident_report.viewincidentreport') }}?A9fKz1LQc=${item_id}`;

        if (is_read == 0) {
            if (notif_type == 'INCIDENTREPORT') {
                readTheNotif(notif_id, () => {
                    window.location = redirect_url;
                })
            }
        } else {
            if (notif_type == 'INCIDENTREPORT') {
                window.location = redirect_url;
            }
        }
    });

    function readTheNotif(notif_id, callback = null) {
        postRequest("{{ route('global.readNotif') }}", {
            notif_id: notif_id
        }, (response) => {
            if (response.status == 'success') {
                callback();
            } else {
                Swal.fire({
                    title: "Failed",
                    text: "Something's Wrong",
                    icon: "error"
                });
            }
        })
    }

    function skeletonNotif() {
        let notifSkeletonHTML = "";
        for (let i = 1; i <= 5; i++) {
            notifSkeletonHTML += `
               <div class="px-3 py-1 d-flex gap-2 align-items-center">
                    <div style="width: 55px; height: 55px; flex-shrink: 0" class="rounded-circle skeleton"></div>
                    <div>
                        <div style="height: 15px; width: 175px" class="skeleton"></div>
                        <div style="height: 11px; width: 235px" class="skeleton"></div>
                        <div style="height: 9px; width: 135px" class="skeleton"></div>
                    </div>
                </div>
            `;
        }

        $("#notificationDiv").html(notifSkeletonHTML);
    }
</script>
