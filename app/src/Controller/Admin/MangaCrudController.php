<?php

namespace App\Controller\Admin;

use App\Entity\Manga;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class MangaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Manga::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category')->setCrudController(CategoryCrudController::class),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),              
        ];
    }
    
}
