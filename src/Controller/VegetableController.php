<?php

namespace App\Controller;

use App\Entity\Vegetable;
use App\Repository\VegetableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VegetableController extends AbstractController
{

    #[Route('/vegetable', name: 'vegetable_index')]
    public function index(VegetableRepository $vegetableRepository): Response
    {
        return $this->render('vegetable/index.html.twig', [
            'vegetables' => $vegetableRepository->findAll()
        ]);
    }

    #[Route('vegetable/add',name:'vegetable_add')]
    public function add(VegetableRepository $vegetableRepository) : Response
    {
        // Add a new vegatable into the database

        $vegateble = new Vegetable();

        $vegateble->setName('Radis');
        $vegateble->setDescription('Le radis cultivé, Raphanus sativus (du latin radix, radicis, « racine, raifort », du grec ῥαπυς, ῥαπυος, « rave, navet ») est une plante potagère annuelle ou bisannuelle de la famille des Brassicacées, principalement cultivée pour son hypocotyle charnu, souvent consommé cru, comme légume.
        Toutes les parties de la plante sont comestibles, bien que sa racine pivot soit plus populaire. La peau et la chair du radis peuvent être de différentes couleurs, dont la plus courante est le rouge. Certaines variétés peuvent être bicolores, roses, violettes, vertes, blanches ou noires.');
        $vegateble->setFamily('Raphanus sativus');
        $vegateble->setImage('https://www.rustica.fr/images/okradis1-l870-h630.jpg');

        $vegetableRepository->save($vegateble,true);

        return $this->redirectToRoute('vegetable_index');
    }
}
