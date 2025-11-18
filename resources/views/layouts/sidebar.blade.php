<style>
    .sidbarContainer {
        width: 250px;
        height: 100vh;
        overflow: auto;
        background: #3D7C77;               /* Sirf ek solid Teal Green */
        position: fixed;
        left: 0;
        top: 80px;
        padding: 0 !important;
        box-shadow: 3px 0 15px rgba(0,0,0,0.15);
        z-index: 10;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Sab links ek jaise — koi hover, koi change nahi */
    .sidbarContainer a,
    .location-item {
        display: block;
        padding: 14px 18px !important;
        color: #FFFFFF !important;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.12);
        transition: none !important;
    }

    /* Hover bilkul band — kuch bhi nahi hoga */
    .sidbarContainer a:hover,
    .location-item:hover {
        background: transparent !important;
        color: #FFFFFF !important;
        transform: none !important;
        border-left: none !important;
    }

    .sidbarContainer i {
        width: 22px;
        text-align: center;
        margin-right: 12px;
        font-size: 15px;
    }

    /* Dashboard Title — bhi same color mein */
    .dashboard-title {
        background: #3D7C77;
        color: #FFFFFF !important;
        font-weight: bold;
        font-size: 17px;
        text-align: center;
        padding: 18px !important;
        border-bottom: 3px solid #9ED8D2;   /* Sirf thodi si highlight line */
    }

    /* Section Title */
    .section-title {
        color: #FFFFFF !important;
        font-weight: bold;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 16px 18px 10px !important;
        background: rgba(255,255,255,0.08);
        border-bottom: 2px solid #9ED8D2;
    }

    /* No gaps, clean look */
    #locationList {
        margin: 0 !important;
        padding: 0 !important;
    }

    #locationList a:last-child {
        border-bottom: none;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .sidbarContainer {
            width: 100%;
            height: auto;
            position: relative;
            top: 0;
        }
    }
</style>

<div class="sidbarContainer">
    <a href="/dashboard" class="dashboard-title">
        <i class="fa fa-dashboard"></i> HWH Dashboard
    </a>

    <a href="/detailReports" class="location-item">
        <i class="fa fa-file-text"></i> Detail Report
    </a>

    <div class="section-title">
        <i class="fa fa-map-marker"></i> Institution Location
    </div>

    <div id="locationList">
        <a class="location-item" data-ph="4235150031" data-ad="Lahore..." data-src="https://www.google.com/maps/embed?...">
            <i class="fa fa-building"></i> Lahore
        </a>
        <a class="location-item" data-ph="049330231" data-ad="Multan..." data-src="...">
            <i class="fa fa-building"></i> Multan
        </a>
        <a class="location-item" data-ph="542470282" data-ad="Narowal..." data-src="...">
            <i class="fa fa-building"></i> Narowal
        </a>
        <a class="location-item" data-ph="542470282" data-ad="Rawalpindi..." data-src="...">
            <i class="fa fa-building"></i> Rawalpindi
        </a>
        <a class="location-item" data-ph="409200413" data-ad="Sahiwal..." data-src="...">
            <i class="fa fa-building"></i> Sahiwal
        </a>
        <a class="location-item" data-ph="409200413" data-ad="Toba Tek Singh..." data-src="...">
            <i class="fa fa-building"></i> Toba Tek Singh
        </a>
        <a class="location-item" data-ph="049330231" data-ad="Faisalabad..." data-src="...">
            <i class="fa fa-building"></i> Faisalabad
        </a>
    </div>
</div>

<!-- Hover wala JavaScript bhi hata diya — ab kuch nahi hoga click/hover par -->