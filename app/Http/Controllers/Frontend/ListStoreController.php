<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Http\Supports\RepositoryUtil;
use App\Repositories\ShopRepository;

class ListStoreController extends FrontendController
{
    use RepositoryUtil;

    public function __construct(ShopRepository $shopRepository)
    {
        parent::__construct();
        $this->setRepository($shopRepository);
    }

    public function displayListStore()
    {
        $listShop = $this->getRepository()->getShopForFrontend([]);
        $data = [];
        $show =[];
        foreach ($listShop as $shop) {
            $data[$shop->pref][$shop->address][$shop->address1][] = $shop;
        }
        foreach (getConfig('prefs') as $prefIndex => $prefName){
            if (isset($data[$prefName])) {
                $show[$prefName] = $data[$prefName];
            }
        }
        $this->setViewData([
            'listShop' => $show
        ]);
        return $this->render('frontend.list-store.index');
    }
}
