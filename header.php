<?php
declare(strict_types=1);

if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(404);
    exit('Not Found');
}

$currentPage = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '');

if ($currentPage === '' || $currentPage === '/') {
    $currentPage = 'index.php';
}

$sectionMap = [
    'home' => ['index.php', 'index.html', 'index-2.html', 'index-3.html', 'tata.html'],
    'company' => ['about.html', 'director-desk.html', 'company-milestones.html', 'client-testimonial.html'],
    'products' => [
        'epcb9ca.html',
        'epc83cc.html',
        'waaree-products65e1.html',
        'waaree-products88e9.html',
        'waaree-products290d.html',
        'waaree-productsa83e.html',
        'waaree-products1164.html',
        'solar-model9c2a.html',
        'solar-modelb1de.html',
        'solar-farma8f2.html',
        'solar-farmf31c.html',
    ],
    'gallery' => ['project-gallery.html', 'completed-project.html', 'celebration.html', 'suryamitra-team.html'],
    'career' => ['career.html'],
    'news' => ['whats-new.html'],
    'contact' => ['contact.html', 'contact-2.html'],
];

$currentSection = '';

foreach ($sectionMap as $section => $pages) {
    if (in_array($currentPage, $pages, true)) {
        $currentSection = $section;
        break;
    }
}

$isSection = static function (string $section) use ($currentSection): string {
    return $currentSection === $section ? ' current ' : '';
};
?>
<header class="main-header header-style-two">
    <div class="header-upper">
        <div class="container-fluid">
            <div class="logo-outer">
                <div class="logo">
                    <a href="index.php"><img src="images/suryamitra-solution.png" alt="SuryaMitra Renewables Pvt. Ltd." title="SuryaMitra Renewables Pvt. Ltd."></a>
                </div>
            </div>
            <div class="nav-outer clearfix">
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon flaticon-menu-button"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li class="<?php echo $isSection('home'); ?>"><a href="index.php">Home</a></li>
                            <li class="dropdown <?php echo $isSection('company'); ?>"><a href="#">Company</a>
                                <ul>
                                    <li><a href="about.html">Company Profile</a></li>
                                    <li><a href="director-desk.html">Director's Desk</a></li>
                                    <li><a href="company-milestones.html">Company Milestones</a></li>
                                    <li><a href="client-testimonial.html">Client's Testimonials</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('products'); ?>"><a href="#">Products &amp; Solutions</a>
                                <ul>
                                    <li class="dropdown"><a href="#">EPC</a>
                                        <ul>
                                            <li><a href="epcb9ca.html?product=Residential-Solar-Rooftop">Residential Solar Rooftop</a></li>
                                            <li><a href="epc83cc.html?product=Commercial-and-Industrial-Solar-Plant">Commercial and Industrial Solar Plant</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">WAAREE Products</a>
                                        <ul>
                                            <li><a href="waaree-products65e1.html?product=PV-Module">PV Module</a></li>
                                            <li><a href="waaree-products88e9.html?product=Inverter">Inverter</a></li>
                                            <li><a href="waaree-products290d.html?product=Batteries">Batteries</a></li>
                                            <li><a href="waaree-productsa83e.html?product=Solar-Water-Pump">Solar Water Pump</a></li>
                                            <li><a href="waaree-products1164.html?product=Solar-Thermal">Solar Thermal</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="solar-model9c2a.html?product=CAPEX-BOOT-solar-model">CAPEX / BOOT solar model</a></li>
                                    <li><a href="solar-modelb1de.html?product=OPEX-RESCO-solar-model">OPEX / RESCO solar model</a></li>
                                    <li class="dropdown"><a href="#">Solar Farm</a>
                                        <ul>
                                            <li><a href="solar-farma8f2.html?product=Third-Party-(Open-Access)">Third Party (Open Access)</a></li>
                                            <li><a href="solar-farmf31c.html?product=Group-Captive">Group Captive</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('gallery'); ?>"><a href="#">Gallery</a>
                                <ul>
                                    <li><a href="project-gallery.html">Project Gallery</a></li>
                                    <li><a href="completed-project.html">Completed Projects</a></li>
                                    <li><a href="celebration.html">Celebration</a></li>
                                    <li><a href="suryamitra-team.html">Surya Mitra's Family</a></li>
                                </ul>
                            </li>
                            <li><a href="https://www.waaree.com/blog" target="_blank" rel="noopener">Blog</a></li>
                            <li class="<?php echo $isSection('career'); ?>"><a href="career.html">Career</a></li>
                            <li class="<?php echo $isSection('news'); ?>"><a href="whats-new.html" class="blinking-text">What's New</a></li>
                            <li class="<?php echo $isSection('contact'); ?>"><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="outer-box clearfix">
                    <div class="btn-box">
                        <a href="download-brochure.html" class="contact-btn btn-style-one">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="auto-container clearfix">
            <div class="logo pull-left">
                <a href="index.php" title="SuryaMitra Renewables"><img src="images/suryamitra-solution.png" alt="SuryaMitra Renewables" title="SuryaMitra Renewables"></a>
            </div>
            <div class="pull-right">
                <nav class="main-menu">
                    <div class="navbar-collapse show collapse clearfix">
                        <ul class="navigation clearfix">
                            <li class="<?php echo $isSection('home'); ?>"><a href="index.php">Home</a></li>
                            <li class="dropdown <?php echo $isSection('company'); ?>"><a href="#">Company</a>
                                <ul>
                                    <li><a href="about.html">Company Profile</a></li>
                                    <li><a href="director-desk.html">Director's Desk</a></li>
                                    <li><a href="company-milestones.html">Company Milestones</a></li>
                                    <li><a href="client-testimonial.html">Client's Testimonials</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('products'); ?>"><a href="#">Products &amp; Solutions</a>
                                <ul>
                                    <li class="dropdown"><a href="#">EPC</a>
                                        <ul>
                                            <li><a href="epcb9ca.html?product=Residential-Solar-Rooftop">Residential Solar Rooftop</a></li>
                                            <li><a href="epc83cc.html?product=Commercial-and-Industrial-Solar-Plant">Commercial and Industrial Solar Plant</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                    <li class="dropdown"><a href="#">WAAREE Products</a>
                                        <ul>
                                            <li><a href="waaree-products65e1.html?product=PV-Module">PV Module</a></li>
                                            <li><a href="waaree-products88e9.html?product=Inverter">Inverter</a></li>
                                            <li><a href="waaree-products290d.html?product=Batteries">Batteries</a></li>
                                            <li><a href="waaree-productsa83e.html?product=Solar-Water-Pump">Solar Water Pump</a></li>
                                            <li><a href="waaree-products1164.html?product=Solar-Thermal">Solar Thermal</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                    <li><a href="solar-model9c2a.html?product=CAPEX-BOOT-solar-model">CAPEX / BOOT solar model</a></li>
                                    <li><a href="solar-modelb1de.html?product=OPEX-RESCO-solar-model">OPEX / RESCO solar model</a></li>
                                    <li class="dropdown"><a href="#">Solar Farm</a>
                                        <ul>
                                            <li><a href="solar-farma8f2.html?product=Third-Party-(Open-Access)">Third Party (Open Access)</a></li>
                                            <li><a href="solar-farmf31c.html?product=Group-Captive">Group Captive</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('gallery'); ?>"><a href="#">Gallery</a>
                                <ul>
                                    <li><a href="project-gallery.html">Project Gallery</a></li>
                                    <li><a href="completed-project.html">Completed Projects</a></li>
                                    <li><a href="celebration.html">Celebration</a></li>
                                    <li><a href="suryamitra-team.html">Surya Mitra's Family</a></li>
                                </ul>
                            </li>
                            <li><a href="https://www.waaree.com/blog" target="_blank" rel="noopener">Blog</a></li>
                            <li class="<?php echo $isSection('career'); ?>"><a href="career.html">Career</a></li>
                            <li class="<?php echo $isSection('news'); ?>"><a href="whats-new.html" class="blinking-text">What's New</a></li>
                            <li class="<?php echo $isSection('contact'); ?>"><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="outer-box clearfix">
                    <div class="btn-box">
                        <a href="download-brochure.html" class="contact-btn btn-style-one">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
