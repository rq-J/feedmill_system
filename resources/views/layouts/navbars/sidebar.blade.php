<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header" style="height:6em">
        <div class="navbar-brand" style="padding-top:0;">
            <a class="align-items-center m-0  text-wrap h-100" href="">
                <img src="{{ asset('assets/img/icons/BFC.png') }}" class="w-100" alt="...">
                {{-- <span class="font-weight-bold"
                    style="letter-spacing: 0px; display: flex;
                justify-content: center;
                align-items: center;">Feedmill
                    System</span> --}}
            </a>
        </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-75" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="address-card"
                            class="svg-inline--fa fa-address-card fa-w-18" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M512 32H64C28.654 32 0 60.654 0 96V416C0 451.346 28.654 480 64 480H512C547.346 480 576 451.346 576 416V96C576 60.654 547.346 32 512 32ZM176 128C211.346 128 240 156.654 240 192S211.346 256 176 256S112 227.346 112 192S140.654 128 176 128ZM272 384H80C71.164 384 64 376.836 64 368C64 323.816 99.816 288 144 288H208C252.184 288 288 323.816 288 368C288 376.836 280.836 384 272 384ZM496 320H368C359.164 320 352 312.836 352 304S359.164 288 368 288H496C504.836 288 512 295.164 512 304S504.836 320 496 320ZM496 256H368C359.164 256 352 248.836 352 240S359.164 224 368 224H496C504.836 224 512 231.164 512 240S504.836 256 496 256ZM496 192H368C359.164 192 352 184.836 352 176S359.164 160 368 160H496C504.836 160 512 167.164 512 176S504.836 192 496 192Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M176 256C211.346 256 240 227.346 240 192S211.346 128 176 128S112 156.654 112 192S140.654 256 176 256ZM208 288H144C99.816 288 64 323.816 64 368C64 376.836 71.164 384 80 384H272C280.836 384 288 376.836 288 368C288 323.816 252.184 288 208 288Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Ingredient Storage</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('macro') ? 'active' : '' }} " href="{{ url('macro') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="wheat"
                            class="svg-inline--fa fa-wheat fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M415.928 141.322L54.625 502.625C48.375 508.875 40.187 512 32 512S15.625 508.875 9.375 502.625C-3.125 490.125 -3.125 469.875 9.375 457.375L369.717 97.033C366.646 119.809 368.482 139.045 369.113 143.398C384.859 144.486 400.629 143.541 415.928 141.322Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M144.525 306.387C144.4 259.516 98.4 221.391 92.15 216.641C64.277 241.016 41.402 272.641 40.277 306.137C41.277 334.631 58.9 362.506 81.15 385.129L141.525 324.754C143.15 318.76 144.275 312.76 144.525 306.387ZM31.529 512C37.68 512 43.557 509.65 48.887 506.123C42.865 510.111 35.863 511.881 29 511.508C29.857 511.576 30.67 512 31.529 512ZM243.273 223.006C244.898 217.01 246.146 210.887 246.396 204.516C246.271 157.77 200.273 119.523 194.023 114.898C166.148 139.273 143.275 170.895 142.025 204.391C143.15 232.889 160.771 260.762 183.02 283.26L243.273 223.006ZM345.145 121.137C346.77 115.143 347.895 109.143 348.145 102.77C348.02 55.898 302.02 17.773 295.77 13.023C267.896 37.398 245.021 69.023 243.896 102.52C244.896 131.014 262.52 158.889 284.77 181.512L345.145 121.137ZM409.643 163.641C403.018 163.641 396.643 164.766 390.393 166.391L330.02 226.762C352.77 249.512 380.393 266.883 409.393 267.883C442.641 266.633 475.139 243.012 499.139 215.641C482.139 196.141 448.891 165.016 409.643 163.641ZM307.77 265.516C301.145 265.516 294.77 266.516 288.645 268.141L228.271 328.508C250.896 351.383 278.52 368.758 307.645 369.758C340.768 368.508 373.268 344.883 397.391 317.387C380.393 298.012 347.018 266.766 307.77 265.516ZM206.023 367.258C199.398 367.258 193.023 368.383 186.773 370.008L126.4 430.379C149.15 453.129 176.773 470.5 205.773 471.5C239.021 470.25 271.52 446.629 295.52 419.258C278.52 399.758 245.271 368.633 206.023 367.258ZM481.264 113.523C506.639 86.148 513.637 41.527 511.014 0.531C482.014 -1.344 430.766 0.281 398.391 30.402C361.268 67.773 367.393 134.773 368.643 143.398C410.266 146.273 453.639 139.273 481.264 113.523Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Macro</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('micro') ? 'active' : '' }}"
                    href="{{ url('micro') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                            data-icon="flask-round-potion" class="svg-inline--fa fa-flask-round-potion fa-w-14"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M319.965 169V64H327.961C341.219 64 351.961 53.254 351.961 40V24C351.961 10.742 341.219 0 327.961 0H119.992C106.734 0 95.992 10.742 95.992 24V40C95.992 53.254 106.734 64 119.992 64H127.984V168.125C61.617 202.875 16 271.875 16 352C16 405.75 36.375 454.75 69.992 491.75C81.867 504.875 99.117 512 116.988 512H330.961C348.961 512 366.461 504.5 378.461 491.125C410.703 455.375 430.703 408.375 431.953 356.625C433.703 276.75 387.207 205.125 319.965 169ZM330.961 448L117.359 448.711C93.27 422.195 80 387.848 80 352C80 266.026 140.643 233.742 191.984 206.855V64H255.965V207.27C293.043 227.188 370.018 261.811 367.973 355.078C367.137 389.613 353.984 422.703 330.961 448Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M367.879 352C367.875 353.055 367.996 354.012 367.973 355.078C367.137 389.613 353.984 422.703 330.961 448L117.359 448.711C93.27 422.195 80 387.848 80 352C80 345.762 80.961 340.383 81.57 334.691C147.164 302.625 208.672 304.594 262.742 331.5C307.891 353.961 344.258 352.008 367.879 352Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Micro</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('medicine') ? 'active' : '' }}"
                    href="{{ url('medicine') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="pills"
                            class="svg-inline--fa fa-pills fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M299.755 226.25C296.255 222.75 290.255 223.25 287.38 227.125C242.129 289.625 247.004 377.25 303.255 433.5C359.631 489.75 447.257 494.75 509.758 449.375C513.758 446.5 514.008 440.625 510.508 437.125L299.755 226.25ZM529.509 207.25C473.258 151 385.631 146.125 323.13 191.375C319.13 194.25 318.755 200.25 322.255 203.75L533.134 414.5C536.634 418.001 542.509 417.625 545.384 413.75C590.76 351.125 585.885 263.625 529.509 207.25ZM112.002 32C50.126 32 0 82.125 0 144V256H224.004V144C224.004 82.125 173.878 32 112.002 32Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M224.004 256V368C224.004 429.875 173.878 480 112.002 480S0 429.875 0 368V256H224.004Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Medicine</span>
                </a>
            </li>


            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Records Inventory Managements
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('feed_request') ? 'active' : '' }} "
                    href="{{ url('feed_request') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="note-sticky"
                            class="svg-inline--fa fa-note-sticky fa-w-14" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M448 80V320H384V96H64V416H288V480H48C21.49 480 0 458.51 0 432V80C0 53.49 21.49 32 48 32H400C426.51 32 448 53.49 448 80Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M448 320V325.49C448 342.463 441.258 358.742 429.254 370.744L338.746 461.254C326.742 473.256 310.465 480 293.49 480H288V352C288 334.326 302.328 320 320 320H448Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Feed Request Records</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('farm_information') ? 'active' : '' }}"
                    href="{{ url('farm_information') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="circle-info"
                            class="svg-inline--fa fa-circle-info fa-w-16" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M256 16C123.449 16 16 123.508 16 256C16 388.578 123.449 496 256 496S496 388.578 496 256C496 123.508 388.551 16 256 16ZM256 128C273.674 128 288 142.326 288 160C288 177.672 273.674 192 256 192S224 177.672 224 160C224 142.326 238.326 128 256 128ZM296 384H216C202.75 384 192 373.25 192 360S202.75 336 216 336H232V272H224C210.75 272 200 261.25 200 248S210.75 224 224 224H256C269.25 224 280 234.75 280 248V336H296C309.25 336 320 346.75 320 360S309.25 384 296 384Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M256 192C273.674 192 288 177.672 288 160C288 142.326 273.674 128 256 128S224 142.326 224 160C224 177.672 238.326 192 256 192ZM296 336H280V248C280 234.75 269.25 224 256 224H224C210.75 224 200 234.75 200 248S210.75 272 224 272H232V336H216C202.75 336 192 346.75 192 360S202.75 384 216 384H296C309.25 384 320 373.25 320 360S309.25 336 296 336Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Farm Information’s</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Forecasting</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('inventory_levels') ? 'active' : '' }}"
                    href="{{ url('inventory_levels') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="eye"
                            class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M572.531 238.973C518.281 115.525 410.938 32 288 32S57.688 115.58 3.469 238.973C1.562 243.402 0 251.041 0 256C0 260.977 1.562 268.596 3.469 273.025C57.719 396.473 165.062 480 288 480S518.312 396.418 572.531 273.025C574.438 268.596 576 260.957 576 256C576 251.023 574.438 243.402 572.531 238.973ZM432 256.062C432 335.516 367.531 400 288.062 400H288C208.5 400 144 335.484 144 256S208.5 112 288 112S432 176.516 432 256V256.062Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M288 160H287.781C285.48 160.029 282.426 160.441 279.539 160.764C284.77 170.037 288 180.594 288 192C288 227.346 259.346 256 224 256C212.551 256 201.959 252.748 192.66 247.482C192.363 250.479 192 253.625 192 256C192 308.996 235.004 352 288 352S384 308.996 384 256S340.996 160 288 160Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Inventory Levels</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('message_slack') ? 'active' : '' }}"
                    href="{{ url('message_slack') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                            data-icon="comment-exclamation" class="svg-inline--fa fa-comment-exclamation fa-w-16"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M256 32C114.594 32 0 125.094 0 240C0 289.594 21.406 335 57 370.703C44.5 421.094 2.688 466 2.188 466.5C0 468.797 -0.594 472.203 0.688 475.203C2 478.203 4.812 480 8 480C74.312 480 124 448.203 148.594 428.594C181.312 440.906 217.594 448 256 448C397.406 448 512 354.906 512 240S397.406 32 256 32ZM232 136C232 122.75 242.75 112 256 112S280 122.75 280 136V248C280 261.25 269.25 272 256 272S232 261.25 232 248V136ZM256 368C238.328 368 224 353.672 224 336C224 318.326 238.328 304 256 304S288 318.326 288 336C288 353.672 273.672 368 256 368Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M256 272C269.25 272 280 261.25 280 248V136C280 122.75 269.25 112 256 112S232 122.75 232 136V248C232 261.25 242.75 272 256 272ZM256 304C238.328 304 224 318.326 224 336C224 353.672 238.328 368 256 368S288 353.672 288 336C288 318.326 273.672 304 256 304Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Message on Slack</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Production Management</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('production_order') ? 'active' : '' }} "
                    href="{{ url('production_order') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="gears"
                            class="svg-inline--fa fa-gears fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M628.871 318.174C627.855 313.334 623.418 309.941 618.475 309.941H584.381C579.055 294.723 571.018 280.963 560.721 268.984L577.813 239.387C578.783 237.707 579.262 235.828 579.262 233.967C579.262 231.074 578.105 228.223 575.846 226.219C559.018 211.297 539.164 199.758 517.328 192.508C512.625 190.947 507.408 193.098 504.93 197.391L488.162 226.432C480.33 224.934 472.295 224 464.029 224C455.893 224 447.99 224.943 440.273 226.395L423.533 197.391C421.053 193.098 415.834 190.947 411.131 192.508C389.299 199.758 369.439 211.297 352.615 226.219C350.355 228.223 349.195 231.076 349.195 233.967C349.195 235.828 349.674 237.705 350.646 239.387L367.57 268.699C357.162 280.74 349.043 294.605 343.678 309.941H309.984C305.043 309.941 300.602 313.334 299.586 318.174C297.299 329.102 296 340.391 296 352C296 363.607 297.299 374.896 299.586 385.824C300.602 390.664 305.043 394.057 309.984 394.057H343.674C349.039 409.393 357.162 423.258 367.57 435.301L350.646 464.613C349.674 466.293 349.195 468.172 349.195 470.033C349.195 472.924 350.355 475.775 352.615 477.781C369.439 492.703 389.299 504.242 411.131 511.492C415.834 513.055 421.053 510.902 423.533 506.609L440.273 477.605C447.986 479.057 455.893 480 464.029 480C472.297 480 480.33 479.066 488.162 477.568L504.93 506.609C507.408 510.902 512.625 513.055 517.328 511.492C539.164 504.242 559.018 492.703 575.846 477.781C578.105 475.775 579.262 472.924 579.262 470.033C579.262 468.172 578.783 466.297 577.812 464.613L560.721 435.016C571.018 423.037 579.059 409.275 584.383 394.057H618.475C623.418 394.057 627.855 390.664 628.871 385.824C631.158 374.896 632.459 363.607 632.459 352C632.459 340.391 631.158 329.102 628.871 318.174ZM464.029 400C437.518 400 416.029 378.51 416.029 352S437.518 304 464.029 304C490.539 304 512.029 325.49 512.029 352S490.539 400 464.029 400Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M285.605 199.955C287.057 192.24 288 184.336 288 176.199C288 167.932 287.066 159.896 285.568 152.066L314.609 135.299C318.902 132.818 321.055 127.604 319.492 122.9C312.242 101.064 300.703 81.211 285.781 64.381C283.775 62.123 280.924 60.967 278.033 60.967C276.172 60.967 274.297 61.445 272.613 62.416L243.016 79.506C231.037 69.211 217.275 61.17 202.057 55.846V21.754C202.057 16.811 198.664 12.373 193.824 11.357C182.897 9.068 171.607 7.77 160 7.77C148.391 7.77 137.102 9.068 126.174 11.357C121.334 12.373 117.941 16.811 117.941 21.754V55.848C102.723 61.172 88.963 69.211 76.984 79.506L47.387 62.416C45.707 61.445 43.828 60.967 41.967 60.967C39.074 60.967 36.223 62.123 34.219 64.381C19.297 81.211 7.758 101.064 0.508 122.9C-1.053 127.604 1.098 132.818 5.391 135.299L34.432 152.066C32.934 159.896 32 167.934 32 176.199C32 184.336 32.943 192.238 34.395 199.953L5.391 216.695C1.098 219.176 -1.053 224.395 0.508 229.098C7.758 250.93 19.297 270.787 34.219 287.613C36.223 289.873 39.076 291.031 41.967 291.031C43.828 291.031 45.705 290.553 47.387 289.582L76.699 272.656C88.74 283.066 102.605 291.186 117.941 296.551V330.244C117.941 335.186 121.334 339.625 126.174 340.641C137.102 342.93 148.391 344.229 160 344.229C171.607 344.229 182.897 342.93 193.824 340.641C198.664 339.625 202.057 335.186 202.057 330.244V296.553C217.393 291.187 231.258 283.066 243.301 272.656L272.613 289.582C274.293 290.553 276.172 291.031 278.033 291.031C280.924 291.031 283.775 289.873 285.781 287.613C300.703 270.787 312.242 250.93 319.492 229.098C321.055 224.395 318.902 219.176 314.609 216.695L285.605 199.955ZM160 224.199C133.49 224.199 112 202.709 112 176.199S133.49 128.199 160 128.199S208 149.689 208 176.199S186.51 224.199 160 224.199Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Production Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('premixes') ? 'active' : '' }}"
                    href="{{ url('premixes') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="mortar-pestle"
                            class="svg-inline--fa fa-mortar-pestle fa-w-16" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M402.375 160H251L454.75 7.125C465.625 -1 480 -2.25 492.125 3.75C513.875 14.625 518.625 43.75 501.375 60.875L402.375 160Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M496 192H16C7.125 192 0 199.125 0 208V240C0 248.875 7.125 256 16 256H32C32 337 82.25 406.125 153.125 434.375C140.375 451.25 131.375 471.125 128.125 493C126.75 502.875 134.25 512 144.25 512H367.75C377.75 512 385.25 502.875 383.875 493C380.625 471.125 371.625 451.25 358.875 434.375C429.75 406.125 480 337 480 256H496C504.875 256 512 248.875 512 240V208C512 199.125 504.875 192 496 192Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Premixes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('raw_materials') ? 'active' : '' }}"
                    href="{{ url('raw_materials') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center P-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                            data-icon="flask-round-potion" class="svg-inline--fa fa-flask-round-potion fa-w-14"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M319.965 169V64H327.961C341.219 64 351.961 53.254 351.961 40V24C351.961 10.742 341.219 0 327.961 0H119.992C106.734 0 95.992 10.742 95.992 24V40C95.992 53.254 106.734 64 119.992 64H127.984V168.125C61.617 202.875 16 271.875 16 352C16 405.75 36.375 454.75 69.992 491.75C81.867 504.875 99.117 512 116.988 512H330.961C348.961 512 366.461 504.5 378.461 491.125C410.703 455.375 430.703 408.375 431.953 356.625C433.703 276.75 387.207 205.125 319.965 169ZM330.961 448L117.359 448.711C93.27 422.195 80 387.848 80 352C80 266.026 140.643 233.742 191.984 206.855V64H255.965V207.27C293.043 227.188 370.018 261.811 367.973 355.078C367.137 389.613 353.984 422.703 330.961 448Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M367.879 352C367.875 353.055 367.996 354.012 367.973 355.078C367.137 389.613 353.984 422.703 330.961 448L117.359 448.711C93.27 422.195 80 387.848 80 352C80 345.762 80.961 340.383 81.57 334.691C147.164 302.625 208.672 304.594 262.742 331.5C307.891 353.961 344.258 352.008 367.879 352Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Raw Materials</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Reports</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('accounting_bills') ? 'active' : '' }} "
                    href="{{ url('accounting_bills') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="newspaper"
                            class="svg-inline--fa fa-newspaper fa-w-16" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M480 32H128C110.326 32 96 46.326 96 64V432C96 458.51 74.51 480 48 480H448C483.346 480 512 451.346 512 416V64C512 46.326 497.674 32 480 32ZM288 408C288 412.418 284.418 416 280 416H168C163.582 416 160 412.418 160 408V392C160 387.58 163.582 384 168 384H280C284.418 384 288 387.58 288 392V408ZM288 312C288 316.418 284.418 320 280 320H168C163.582 320 160 316.418 160 312V296C160 291.58 163.582 288 168 288H280C284.418 288 288 291.58 288 296V312ZM448 408C448 412.418 444.418 416 440 416H328C323.582 416 320 412.418 320 408V392C320 387.58 323.582 384 328 384H440C444.418 384 448 387.58 448 392V408ZM448 312C448 316.418 444.418 320 440 320H328C323.582 320 320 316.418 320 312V296C320 291.58 323.582 288 328 288H440C444.418 288 448 291.58 448 296V312ZM448 208C448 216.836 440.836 224 432 224H176C167.164 224 160 216.836 160 208V112C160 103.162 167.164 96 176 96H432C440.836 96 448 103.162 448 112V208Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M280 384H168C163.582 384 160 387.58 160 392V408C160 412.418 163.582 416 168 416H280C284.418 416 288 412.418 288 408V392C288 387.58 284.418 384 280 384ZM280 288H168C163.582 288 160 291.58 160 296V312C160 316.418 163.582 320 168 320H280C284.418 320 288 316.418 288 312V296C288 291.58 284.418 288 280 288ZM440 384H328C323.582 384 320 387.58 320 392V408C320 412.418 323.582 416 328 416H440C444.418 416 448 412.418 448 408V392C448 387.58 444.418 384 440 384ZM440 288H328C323.582 288 320 291.58 320 296V312C320 316.418 323.582 320 328 320H440C444.418 320 448 316.418 448 312V296C448 291.58 444.418 288 440 288ZM0 128V432C0 458.51 21.49 480 48 480S96 458.51 96 432V96H32C14.326 96 0 110.326 0 128Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>

                    </div>
                    <span class="nav-link-text ms-1">Accounting Bills</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('accounting_payrolls') ? 'active' : '' }}"
                    href="{{ url('accounting_payrolls') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                            data-icon="money-bills-simple" class="svg-inline--fa fa-money-bills-simple fa-w-20"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M367.993 304C412.178 304 447.995 261.02 447.995 208S412.178 112 367.993 112S287.991 154.98 287.991 208S323.809 304 367.993 304ZM80.002 432C62.328 432 48.001 417.672 48.001 400V96C21.491 96 0 117.492 0 144V416C0 451.344 28.655 480 64.002 480H496.012C522.523 480 544.013 458.508 544.013 432H80.002Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M591.996 32H144.001C117.493 32 96 53.492 96 80V336C96 362.508 117.493 384 144.001 384H591.996C618.509 384 639.998 362.508 639.998 336V80C639.998 53.492 618.509 32 591.996 32ZM367.991 304C323.806 304 287.989 261.02 287.989 208S323.806 112 367.991 112S447.993 154.98 447.993 208S412.176 304 367.991 304Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Accounting Payrolls</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('audit_logs') ? 'active' : '' }}"
                    href="{{ url('audit_logs') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="typewriter"
                            class="svg-inline--fa fa-typewriter fa-w-16" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M64 192V48C64 21.49 85.49 0 112 0H352V96H448V192H365.25C356.75 192 348.625 195.375 342.625 201.375L329.375 214.625C323.375 220.625 315.25 224 306.75 224H205.25C196.75 224 188.625 220.625 182.625 214.625L169.375 201.375C163.375 195.375 155.25 192 146.75 192H64Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M352 0V96H448L352 0ZM480 192H365.25C356.75 192 348.625 195.375 342.625 201.375L329.375 214.625C323.375 220.625 315.25 224 306.75 224H205.25C196.75 224 188.625 220.625 182.625 214.625L169.375 201.375C163.375 195.375 155.25 192 146.75 192H32C14.4 192 0 206.4 0 224V256C0 273.625 14.375 288 32 288V464C32 490.51 53.49 512 80 512H432C458.51 512 480 490.51 480 464V288C497.625 288 512 273.625 512 256V224C512 206.4 497.6 192 480 192ZM336 296C336 291.625 339.625 288 344 288H360C364.375 288 368 291.625 368 296V312C368 316.375 364.375 320 360 320H344C339.625 320 336 316.375 336 312V296ZM312 352H328C332.375 352 336 355.625 336 360V376C336 380.375 332.375 384 328 384H312C307.625 384 304 380.375 304 376V360C304 355.625 307.625 352 312 352ZM272 296C272 291.625 275.625 288 280 288H296C300.375 288 304 291.625 304 296V312C304 316.375 300.375 320 296 320H280C275.625 320 272 316.375 272 312V296ZM248 352H264C268.375 352 272 355.625 272 360V376C272 380.375 268.375 384 264 384H248C243.625 384 240 380.375 240 376V360C240 355.625 243.625 352 248 352ZM208 296C208 291.625 211.625 288 216 288H232C236.375 288 240 291.625 240 296V312C240 316.375 236.375 320 232 320H216C211.625 320 208 316.375 208 312V296ZM184 352H200C204.375 352 208 355.625 208 360V376C208 380.375 204.375 384 200 384H184C179.625 384 176 380.375 176 376V360C176 355.625 179.625 352 184 352ZM144 296C144 291.625 147.625 288 152 288H168C172.375 288 176 291.625 176 296V312C176 316.375 172.375 320 168 320H152C147.625 320 144 316.375 144 312V296ZM104 320H88C83.625 320 80 316.375 80 312V296C80 291.625 83.625 288 88 288H104C108.375 288 112 291.625 112 296V312C112 316.375 108.375 320 104 320ZM136 384H120C115.625 384 112 380.375 112 376V360C112 355.625 115.625 352 120 352H136C140.375 352 144 355.625 144 360V376C144 380.375 140.375 384 136 384ZM368 440C368 444.375 364.375 448 360 448H152C147.625 448 144 444.375 144 440V424C144 419.625 147.625 416 152 416H360C364.375 416 368 419.625 368 424V440ZM400 376C400 380.375 396.375 384 392 384H376C371.625 384 368 380.375 368 376V360C368 355.625 371.625 352 376 352H392C396.375 352 400 355.625 400 360V376ZM432 312C432 316.375 428.375 320 424 320H408C403.625 320 400 316.375 400 312V296C400 291.625 403.625 288 408 288H424C428.375 288 432 291.625 432 296V312Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Audit Logs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pivot_logs') ? 'active' : '' }}"
                    href="{{ url('pivot_logs') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="scroll"
                            class="svg-inline--fa fa-scroll fa-w-18" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M480 128V352H288V400C288 444.184 252.184 480 208 480C163.818 480 128 444.184 128 400V96C128 60.654 99.348 32 64 32H384C437 32 480 75 480 128Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M64 32C28.654 32 0 60.654 0 96V144C0 152.836 7.164 160 16 160H128V96C128 60.654 99.348 32 64 32ZM560 352H288C288 352 288 397.256 288 400C288 444.184 252.184 480 208 480H464C525.875 480 576 429.875 576 368C576 359.125 568.875 352 560 352Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Pivot Logs</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('accounts') ? 'active' : '' }} "
                    href="{{ url('accounts') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="user"
                            class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M352 128C352 198.691 294.695 256 224 256C153.312 256 96 198.691 96 128S153.312 0 224 0C294.695 0 352 57.309 352 128Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M274.664 304.001H173.336C77.609 304.001 0 381.602 0 477.333C0 496.477 15.523 512.001 34.664 512.001H413.336C432.477 512.001 448 496.477 448 477.333C448 381.602 370.398 304.001 274.664 304.001Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Accounts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('permissions') ? 'active' : '' }}"
                    href="{{ url('permissions') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="users-gear"
                            class="svg-inline--fa fa-users-gear fa-w-20" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M183.906 216C183.906 210.551 184.889 205.371 185.516 200.088C174.613 194.967 162.613 192 149.92 192H88.08C39.438 192 0 233.785 0 285.332C0 295.641 7.887 304 17.615 304H217.07C196.688 280.211 183.906 249.715 183.906 216ZM128 160C172.184 160 208 124.182 208 80S172.184 0 128 0C83.82 0 48 35.818 48 80S83.82 160 128 160ZM368 400C368 383.312 371.398 367.541 376.619 352.637C374.34 352.535 372.193 352 369.887 352H270.113C191.631 352 128 411.693 128 485.332C128 500.059 140.727 512 156.422 512H422.51C389.535 485.611 368 445.518 368 400ZM551.92 192H490.08C477.279 192 465.195 195.037 454.221 200.24C454.834 205.475 455.814 210.604 455.814 216C455.814 237.471 450.189 257.385 441.16 275.344C462.156 263.381 486.107 256 512 256C554.48 256 592.271 274.74 618.629 304H622.385C632.113 304 640 295.641 640 285.332C640 233.785 600.566 192 551.92 192ZM512 160C556.184 160 592 124.182 592 80S556.184 0 512 0C467.82 0 432 35.818 432 80S467.82 160 512 160ZM319.859 112C262.451 112 215.904 158.562 215.904 216C215.904 273.436 262.451 320 319.859 320C377.273 320 423.814 273.436 423.814 216C423.814 158.562 377.273 112 319.859 112Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M597.498 415.818C599.452 405.396 599.452 394.602 597.498 384.182L616.666 373.014C618.901 371.805 619.922 369.199 619.178 366.687C614.153 350.682 605.592 336.072 594.426 323.977C592.752 322.115 589.959 321.65 587.727 322.953L568.559 334.025C560.463 327.139 551.157 321.744 541.108 318.207V295.969C541.108 293.455 539.246 291.223 536.827 290.756C520.266 287.033 503.329 287.127 487.51 290.756C485.092 291.223 483.323 293.455 483.323 295.969V318.207C473.274 321.744 463.967 327.139 455.873 334.025L436.61 322.953C434.471 321.65 431.678 322.115 429.912 323.977C418.745 336.072 410.184 350.682 405.252 366.687C404.508 369.199 405.532 371.805 407.672 373.014L426.84 384.182C424.981 394.602 424.981 405.396 426.84 415.818L407.672 426.984C405.438 428.193 404.508 430.801 405.252 433.312C410.184 449.318 418.745 463.832 429.912 476.021C431.678 477.885 434.379 478.35 436.61 477.047L455.873 465.973C463.967 472.859 473.274 478.256 483.323 481.791V504.031C483.323 506.545 485.092 508.777 487.51 509.242C504.166 512.965 521.01 512.871 536.827 509.242C539.246 508.777 541.108 506.545 541.108 504.031V481.791C551.157 478.256 560.463 472.859 568.559 465.973L587.727 477.047C589.868 478.35 592.752 477.885 594.426 476.021C605.592 463.926 614.153 449.318 619.178 433.312C619.922 430.801 618.901 428.193 616.666 426.984L597.498 415.818ZM512.209 432C494.536 432 480.209 417.672 480.209 400C480.209 382.326 494.536 368 512.209 368S544.209 382.326 544.209 400C544.209 417.672 529.883 432 512.209 432Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Permission</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
