<?php
/**
 * Automatically adds a section with pages, based on specs for the Power of
 * Place project. Requires the ExhibitBuilder plugin.
 */
 
// Require the necessary ExhibitBuilder models.
require_once PLUGIN_DIR.'/ExhibitBuilder/models/ExhibitSection.php';
require_once PLUGIN_DIR.'/ExhibitBuilder/models/ExhibitPage.php';

/**
 * Creates a section and pages for a new exhibit.
 */
function power_of_place_section_and_pages($exhibit)
{
    if ($exhibit->getSectionCount() == 0) {
        // Create a new section.
        $exhibitSection = new ExhibitSection;
        $exhibitSection->exhibit_id = $exhibit->id;
        $exhibitSection->title = current_user()->username;
        $exhibitSection->order = '1';
        $exhibitSection->slug = current_user()->username;
        $exhibitSection->save();

        // Create some new pages
        $pages = array(
            array('title' => 'Objectives', 'layout' => 'text'),
            array('title' => 'Standards', 'layout' => 'text'),
            array('title' => 'Resources', 'layout' => 'image-list-left-thumbs'),
            array('title' => 'Warm Up','layout' => 'text'),
            array('title' => 'New Material', 'layout' => 'text'),
            array('title' => 'Practice', 'layout' => 'text'),
            array('title' => 'Assessment', 'layout' => 'text'),
            array('title' => 'Closure and Reflection', 'layout' => 'text')
        );
    
        $order = 1;
    
        foreach ($pages as $page) {
            $exhibitPage = new ExhibitPage;
            $exhibitPage->section_id = $exhibitSection->id;
            $exhibitPage->order = $order;
            foreach ($page as $key => $value) {
                $exhibitPage->$key = $value;
            }

            $exhibitPage->save();
            $order++;
        }
    }
}

// Add our function to the 'after_save_exhibit' hook.a
add_plugin_hook('after_save_exhibit', 'power_of_place_section_and_pages');

function power_of_place_admin_header($request)
{
    $module = $request->getModuleName();
    $controller = $request->getControllerName();

    // Check if using Exhibits controller, and add the stylesheet for general display of exhibits
    if ($module == 'exhibit-builder' && $controller == 'exhibits') {
        queue_css('power-of-place-exhibit-admin', 'screen');
    }
}

add_plugin_hook('admin_theme_header', 'power_of_place_admin_header');
