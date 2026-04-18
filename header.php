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
    'home' => ['index.php', 'index.html', 'index-2.php', 'index-3.php', 'tata.php'],
    'company' => ['about.php', 'director-desk.php', 'company-milestones.php', 'client-testimonial.php'],
    'products' => [
        'epcb9ca.php',
        'epc83cc.php',
        'waaree-products65e1.php',
        'waaree-products88e9.php',
        'waaree-products290d.php',
        'waaree-productsa83e.php',
        'waaree-products1164.php',
        'solar-model9c2a.php',
        'solar-modelb1de.php',
        'solar-farma8f2.php',
        'solar-farmf31c.php',
    ],
    'gallery' => ['project-gallery.php', 'completed-project.php', 'celebration.php', 'suryamitra-team.php'],
    'career' => ['career-page.php'],
    'news' => ['whats-new.php'],
    'contact' => ['contact-page.php', 'contact-2.php'],
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
                                    <li><a href="about.php">Company Profile</a></li>
                                    <li><a href="director-desk.php">Director's Desk</a></li>
                                    <li><a href="company-milestones.php">Company Milestones</a></li>
                                    <li><a href="client-testimonial.php">Client's Testimonials</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('products'); ?>"><a href="#">Products &amp; Solutions</a>
                                <ul>
                                    <li class="dropdown"><a href="#">EPC</a>
                                        <ul>
                                            <li><a href="epcb9ca.php?product=Residential-Solar-Rooftop">Residential Solar Rooftop</a></li>
                                            <li><a href="epc83cc.php?product=Commercial-and-Industrial-Solar-Plant">Commercial and Industrial Solar Plant</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">WAAREE Products</a>
                                        <ul>
                                            <li><a href="waaree-products65e1.php?product=PV-Module">PV Module</a></li>
                                            <li><a href="waaree-products88e9.php?product=Inverter">Inverter</a></li>
                                            <li><a href="waaree-products290d.php?product=Batteries">Batteries</a></li>
                                            <li><a href="waaree-productsa83e.php?product=Solar-Water-Pump">Solar Water Pump</a></li>
                                            <li><a href="waaree-products1164.php?product=Solar-Thermal">Solar Thermal</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="solar-model9c2a.php?product=CAPEX-BOOT-solar-model">CAPEX / BOOT solar model</a></li>
                                    <li><a href="solar-modelb1de.php?product=OPEX-RESCO-solar-model">OPEX / RESCO solar model</a></li>
                                    <li class="dropdown"><a href="#">Solar Farm</a>
                                        <ul>
                                            <li><a href="solar-farma8f2.php?product=Third-Party-(Open-Access)">Third Party (Open Access)</a></li>
                                            <li><a href="solar-farmf31c.php?product=Group-Captive">Group Captive</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('gallery'); ?>"><a href="#">Gallery</a>
                                <ul>
                                    <li><a href="project-gallery.php">Project Gallery</a></li>
                                    <li><a href="completed-project.php">Completed Projects</a></li>
                                    <li><a href="celebration.php">Celebration</a></li>
                                    <li><a href="suryamitra-team.php">Surya Mitra's Family</a></li>
                                </ul>
                            </li>
                            <li><a href="https://www.waaree.com/blog" target="_blank" rel="noopener">Blog</a></li>
                            <li class="<?php echo $isSection('career'); ?>"><a href="career-page.php">Career</a></li>
                            <li class="<?php echo $isSection('news'); ?>"><a href="whats-new.php" class="blinking-text">What's New</a></li>
                            <li class="<?php echo $isSection('contact'); ?>"><a href="contact-page.php">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="outer-box clearfix">
                    <div class="btn-box">
                        <a href="download-brochure.php" class="contact-btn btn-style-one">Download</a>
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
                                    <li><a href="about.php">Company Profile</a></li>
                                    <li><a href="director-desk.php">Director's Desk</a></li>
                                    <li><a href="company-milestones.php">Company Milestones</a></li>
                                    <li><a href="client-testimonial.php">Client's Testimonials</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('products'); ?>"><a href="#">Products &amp; Solutions</a>
                                <ul>
                                    <li class="dropdown"><a href="#">EPC</a>
                                        <ul>
                                            <li><a href="epcb9ca.php?product=Residential-Solar-Rooftop">Residential Solar Rooftop</a></li>
                                            <li><a href="epc83cc.php?product=Commercial-and-Industrial-Solar-Plant">Commercial and Industrial Solar Plant</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                    <li class="dropdown"><a href="#">WAAREE Products</a>
                                        <ul>
                                            <li><a href="waaree-products65e1.php?product=PV-Module">PV Module</a></li>
                                            <li><a href="waaree-products88e9.php?product=Inverter">Inverter</a></li>
                                            <li><a href="waaree-products290d.php?product=Batteries">Batteries</a></li>
                                            <li><a href="waaree-productsa83e.php?product=Solar-Water-Pump">Solar Water Pump</a></li>
                                            <li><a href="waaree-products1164.php?product=Solar-Thermal">Solar Thermal</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                    <li><a href="solar-model9c2a.php?product=CAPEX-BOOT-solar-model">CAPEX / BOOT solar model</a></li>
                                    <li><a href="solar-modelb1de.php?product=OPEX-RESCO-solar-model">OPEX / RESCO solar model</a></li>
                                    <li class="dropdown"><a href="#">Solar Farm</a>
                                        <ul>
                                            <li><a href="solar-farma8f2.php?product=Third-Party-(Open-Access)">Third Party (Open Access)</a></li>
                                            <li><a href="solar-farmf31c.php?product=Group-Captive">Group Captive</a></li>
                                        </ul>
                                        <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $isSection('gallery'); ?>"><a href="#">Gallery</a>
                                <ul>
                                    <li><a href="project-gallery.php">Project Gallery</a></li>
                                    <li><a href="completed-project.php">Completed Projects</a></li>
                                    <li><a href="celebration.php">Celebration</a></li>
                                    <li><a href="suryamitra-team.php">Surya Mitra's Family</a></li>
                                </ul>
                            </li>
                            <li><a href="https://www.waaree.com/blog" target="_blank" rel="noopener">Blog</a></li>
                            <li class="<?php echo $isSection('career'); ?>"><a href="career-page.php">Career</a></li>
                            <li class="<?php echo $isSection('news'); ?>"><a href="whats-new.php" class="blinking-text">What's New</a></li>
                            <li class="<?php echo $isSection('contact'); ?>"><a href="contact-page.php">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="outer-box clearfix">
                    <div class="btn-box">
                        <a href="download-brochure.php" class="contact-btn btn-style-one">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
