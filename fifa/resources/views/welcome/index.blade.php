<x-welcome-master>
    @section('content')
        <section class="section-welcome-hero">
            
        </section>

        <section class="section-dashboard">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md text-center mb-4">
                        <img src="images/home.jpg" alt="" class="img-fluid shadow rounded img-welcome">
                    </div>

                    <div class="col-md">
                        <div class="padding-left-welcome">
                            <h3 class="heading-welcome-primary">Dashboard-ul Jucatorului</h3>
                            <p class="paragraph">Acest dashboard iti afiseaza statisticile tale din joc cum ar fi meciurile castigate sau pierdute, diferite procentaje, statistici cu privire la campionatele castigate etc.</p>
                            <a class="btn btn-standard ml-0">Cum functioneaza</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-admin">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md mb-4">
                        <div class="padding-right-welcome">
                            <h3 class="heading-welcome-primary">Panou de admin</h3>
                            <p class="paragraph">De acum nu mai este nevoie sa scrii pe hartie rezultatele meciurilor. Iti punem la dispozitie panoul de admin din care poti introduce foarte usor campionatele, scorurile meciurilor etc.</p>
                            <a class="btn btn-standard ml-0">Cum functioneaza</a>
                        </div>
                    </div>

                    <div class="col-md">
                        <img src="images/games.jpg" alt="" class="img-fluid shadow rounded">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-how-it-works">
            <div class="container">
                <div class="row">
                    <div class="how-it-works-box text-center">
                        <h3 class="heading-welcome-primary">Cum functioneaza?</h3>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-welcome-master>