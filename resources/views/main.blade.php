
@extends('mainsh')

@section('startma')
<div class="container photo-container">
    <h2 class="text-center">Добро пожаловать в нашу клинику</h2>
    <div class="row">
        <!-- Фотографии животных -->
        <div class="col-md-6 text-left">
            <h3>Фотографии животных</h3>
            <img src="https://cache3.youla.io/files/images/780_780/5b/ba/5bba4723b5fc2dc012011943.jpg" class="img-fluid mb-2 img-custom" alt="Животное 1">
            <img src="https://cdn.culture.ru/images/6d9aeb26-5998-5fb6-9eb5-55291120dcb1" class="img-fluid mb-2 img-custom" alt="Животное 2">
        </div>
        
        <!-- Фотографии ветеринаров -->
        <div class="col-md-6 text-right">
            <h3>Фотографии ветеринаров</h3>
            <img src="https://cdn2.hubspot.net/hubfs/4878332/bigstock-Veterinary-Clinic-98187251.jpg" class="img-fluid mb-2 img-custom" alt="Ветеринар 1">
            <img src="https://avatars.mds.yandex.net/i?id=796737a89f53e103d876ddc47a82ae8c_l-12325159-images-thumbs&n=13" class="img-fluid mb-2 img-custom" alt="Ветеринар 2">
        </div>
    </div>
</div>
@endsection