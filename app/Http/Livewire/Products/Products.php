<?php

namespace App\Http\Livewire\Products;
use App\Models\products\product_information;
use Livewire\Component;
use Auth;
use Livewire\WithPagination;

class Products extends Component
{
   use WithPagination;
   public $perPage = 25;
   public $search = '';
   public $orderBy = 'proID';
   public $orderAsc = true;

   public function render()
   {

      $products =  product_information::search($this->search)
                     ->join('business','business.business_code','=','product_information.business_code')
                     ->join('product_inventory','product_inventory.productID','=','product_information.id')
                     ->join('product_price','product_price.productID','=','product_information.id')
                     ->whereNull('parentID')
                     ->where('default_inventory','Yes')
                     ->where('default_price','Yes')
                     ->where('product_information.business_code', Auth::user()->business_code)
                     ->select('product_information.id as proID','product_information.created_at as date','product_price.selling_price as price','product_information.product_name as product_name','product_inventory.current_stock as stock','product_information.created_at as date','product_information.business_code as business_code','sku_code','brand','category')
                     ->orderBy($this->orderBy,$this->orderAsc ? 'desc' : 'asc')
                     ->simplePaginate($this->perPage);

      return view('livewire.products.products', compact('products'));
   }
}
