<div class="border-l-4 border-blue-300 rounded-lg p-1 my-1 bg-white shadow">
    <div class="flex items-center justify-between bg-blue-50">
        <div class="flex items-center">
            <button class="border p-2 bg-gray-200 mr-2 show">
                <i class="fas fa-arrow-right"></i>
                <i class="fas fa-arrow-down hidden"></i>
            </button>
            <input type="text" data-id="{{$city->id}}" data-value="{{$city->city_name_fr}}" readonly class="input-city form-control border-0 bg-transparent flex-1 p-0 text-xs" value="{{$city->city_name_fr}}">
            <i class="loader hidden text-gray-500 fas fa-sync fa-spin"></i>
        </div>
        <div class="flex">
            <button class="p-2 edit"><i class="far fa-edit"></i></button>
            <button data-id="{{$city->id}}" class="p-2 destroy_city"><i class="far fa-trash-alt"></i></button>
        </div>
    </div>
    <div class="sector hidden">
        @include('amrani.pages.parameters.city_sector.create', ['city_id'=>$city->id])
        @include('amrani.pages.parameters.city_sector.item', ['sectors'=>$city->sectors])
    </div>
</div>