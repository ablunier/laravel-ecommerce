<?php
namespace ANavallaSuiza\Ecommerce\Product\Observer;

use EasySlugger\Slugger;

class ProductTranslationObserver
{
    public function saving($model)
    {
        if (is_null($model->slug)) {
            $model->slug = $model->name;
        }

        $model->slug = Slugger::slugify($model->slug);
    }
}
