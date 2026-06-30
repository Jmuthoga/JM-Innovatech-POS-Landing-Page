<footer class="admin-footer">
    <div class="container-fluid px-4">
        <div class="footer-content">

            <!-- Left -->
            <div class="footer-left">
                <span>
                    &copy; {{ date('Y') }}
                    <span class="brand">JPOS Systems</span>.
                    All Rights Reserved.
                </span>
            </div>

            <!-- Center -->
            <div class="footer-center">
                <span>
                    <i class="bi bi-shield-check"></i>
                    Secure Ecommerce Administration Panel
                </span>
            </div>

            <!-- Right -->
            <div class="footer-right">
                <span>
                    <i class="bi bi-code-slash"></i>
                    Version <strong>1.0.0</strong>
                </span>

                <span class="divider">|</span>

                <span>
                    Powered by
                    <a href="https://jminnovatechsolution.co.ke"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="developer-link">
                        JM Innovatech Solution
                    </a>
                </span>
            </div>

        </div>
    </div>
</footer>

<style>
:root{
    --sidebar-width:260px;
    --sidebar-collapsed-width:70px;
}

/* ==========================================
   FOOTER
========================================== */

.admin-footer{
    margin-top:auto;
    background:#fff;
    border-top:1px solid #e9ecef;
    box-shadow:0 -2px 10px rgba(0,0,0,.05);
    padding:18px 0;

    margin-left:var(--sidebar-width);
    width:calc(100% - var(--sidebar-width));

    transition:margin-left .25s ease,width .25s ease;
    z-index:10;
}

/* Sidebar collapsed */
body.sidebar-collapsed .admin-footer{
    margin-left:var(--sidebar-collapsed-width);
    width:calc(100% - var(--sidebar-collapsed-width));
}

/* Mobile */
@media (max-width:991.98px){
    .admin-footer{
        margin-left:0;
        width:100%;
    }
}

/* ==========================================
   CONTENT
========================================== */

.footer-content{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
}

.footer-left,
.footer-center,
.footer-right{
    display:flex;
    align-items:center;
    gap:8px;
    color:#6c757d;
    font-size:.9rem;
}

.footer-left{
    flex:1;
}

.footer-center{
    flex:1;
    justify-content:center;
    text-align:center;
}

.footer-right{
    flex:1;
    justify-content:flex-end;
    flex-wrap:wrap;
}

/* ==========================================
   COLORS
========================================== */

.brand{
    color:var(--jpos-blue);
    font-weight:700;
}

.developer-link{
    color:var(--jpos-green);
    font-weight:700;
    text-decoration:none !important;
    transition:color .25s ease;
}

.developer-link:hover,
.developer-link:focus,
.developer-link:active,
.developer-link:visited{
    color:var(--jpos-blue);
    text-decoration:none !important;
}

.footer-center i{
    color:var(--jpos-green);
}

.footer-right i{
    color:var(--jpos-blue);
}

.divider{
    color:#ced4da;
    margin:0 .4rem;
}

/* ==========================================
   TABLET
========================================== */

@media (max-width:991.98px){

    .footer-content{
        flex-direction:column;
        gap:12px;
        text-align:center;
    }

    .footer-left,
    .footer-center,
    .footer-right{
        justify-content:center;
        width:100%;
    }

}

/* ==========================================
   PHONE
========================================== */

@media (max-width:576px){

    .admin-footer{
        padding:15px 0;
    }

    .footer-left,
    .footer-center,
    .footer-right{
        font-size:.82rem;
    }

    .footer-right{
        flex-direction:column;
        gap:6px;
    }

    .divider{
        display:none;
    }

}
</style>