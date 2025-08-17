let loader = `
    <div class="totalLoader">
    <div class="loader">
        <svg viewBox="0 0 80 80">
            <rect x="8" y="8" width="64" height="64"></rect>
            <text
            x="50%"
            y="60%"
            text-anchor="middle"
            fill="black"
            font-size="24"
            font-weight="bold"
            >
            L
            </text>
        </svg>
        </div>

        <div class="loader">
        <svg viewBox="0 0 80 80">
            <rect x="8" y="8" width="64" height="64"></rect>
            <text
            x="50%"
            y="60%"
            text-anchor="middle"
            fill="black"
            font-size="24"
            font-weight="bold"
            >
            O
            </text>
        </svg>
        </div>

        <div class="loader">
        <svg viewBox="0 0 80 80">
            <rect x="8" y="8" width="64" height="64"></rect>
            <text
            x="50%"
            y="60%"
            text-anchor="middle"
            fill="black"
            font-size="24"
            font-weight="bold"
            >
            A
            </text>
        </svg>
        </div>

        <div class="loader">
            <svg viewBox="0 0 80 80">
                <rect x="8" y="8" width="64" height="64"></rect>
                <text
                x="50%"
                y="60%"
                text-anchor="middle"
                fill="black"
                font-size="24"
                font-weight="bold"
                >
                D
                </text>
            </svg>
        </div>
            <div class="loader">
            <svg viewBox="0 0 80 80">
                <rect x="8" y="8" width="64" height="64"></rect>
                <text
                x="50%"
                y="60%"
                text-anchor="middle"
                fill="black"
                font-size="24"
                font-weight="bold"
                >
                I
                </text>
            </svg>
        </div>
            <div class="loader">
            <svg viewBox="0 0 80 80">
                <rect x="8" y="8" width="64" height="64"></rect>
                <text
                x="50%"
                y="60%"
                text-anchor="middle"
                fill="black"
                font-size="24"
                font-weight="bold"
                >
                N
                </text>
            </svg>
        </div>
            <div class="loader">
            <svg viewBox="0 0 80 80">
                <rect x="8" y="8" width="64" height="64"></rect>
                <text
                x="50%"
                y="60%"
                text-anchor="middle"
                fill="black"
                font-size="24"
                font-weight="bold"
                >
                G
                </text>
            </svg>
        </div>
    </div>
`;

let navEntry;
const entries = performance.getEntriesByType("navigation");

if (entries.length > 0) {
    navEntry = entries[0];
} else if (performance.navigation) {
    switch (performance.navigation.type) {
        case performance.navigation.TYPE_RELOAD:
            navEntry = { type: "reload" };
            break;
        case performance.navigation.TYPE_BACK_FORWARD:
            navEntry = { type: "back_forward" };
            break;
        default:
            navEntry = { type: "navigate" };
    }
}

if (navEntry.type === "reload") {
    document.body.insertAdjacentHTML("beforeend", loader);

    setTimeout(() => {
        const loaderEl = document.querySelector(".totalLoader");
        if (loaderEl) loaderEl.remove();
    }, 1000);
}
