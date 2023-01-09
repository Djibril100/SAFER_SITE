<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class BienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bien::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Biens')
            ->setEntityLabelInSingular('Bien')

            ->setPageTitle("index", "Safer - Administration des biens")

            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('reference'),
            TextField::new('intitule'),
            TextField::new('descriptif'),
            TextField::new('localisation'),
            TextField::new('surface'),
            TextField::new('prix'),
            TextField::new('type'),
            TextField::new('categorie'),
            IdField::new('categorie.id')->hideOnForm()


        ];
    }
}
