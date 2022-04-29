<?php

namespace App\Controller;

use GeoIp2\Database\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/city", name="app_city")
     */
    public function city(): Response
    {
        $projectRoot = $this->getParameter('kernel.project_dir');
        // This creates the Reader object, which should be reused across
        // lookups.
        $reader = new Reader($projectRoot.'/assets/vendor/geolite/GeoLite2-City.mmdb');

        // Replace "city" with the appropriate method for your database, e.g.,
        // "country".
        $record = $reader->city('103.162.209.114');
        dd($record);

        echo $record->country->isoCode."\n";
        echo $record->country->name."\n";
        echo $record->country->names['zh-CN']."\n";

        echo $record->mostSpecificSubdivision->name."\n";
        echo $record->mostSpecificSubdivision->isoCode."\n";

        echo $record->city->name."\n";

        echo $record->postal->code."\n";

        echo $record->location->latitude."\n";
        echo $record->location->longitude."\n";

        echo $record->traits->network."\n";

        exit();
    }
}
