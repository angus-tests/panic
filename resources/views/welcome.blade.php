@section('title', 'Panic')

<x-public-layout>
    <x-page-container>

        <x-page-title title="Welcome to Panic" subtitle="A panic reporting website" />

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 px-4 sm:px-6 justify-center">

            @if(count($reports) > 0)
                <!-- Map -->
                <div class="lg:col-span-3">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 class="text-base font-semibold leading-6 text-gray-900">Map</h2>
                            <p class="mt-2 text-sm text-gray-700">A map showing the recent panic reports</p>
                        </div>
                    </div>

                    <!-- Google maps -->
                    <div class="mt-8 border" style="height: 600px;" id="map"></div>
                </div>
            @endif

            <!-- Reports table -->
            <div class="{{ count($reports) > 0 ? 'lg:col-span-2' : 'col-span-full'  }}">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-base font-semibold leading-6 text-gray-900">Reports</h2>
                        <p class="mt-2 text-sm text-gray-700">A list of recent panic reports</p>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Device</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Time</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">View</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse($reports as $report)
                                        <tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$report->name}}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$report->long}} <br> {{$report->lat}}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$report->created_at}}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @if($report->status == "new")
                                                    <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">NEW</span>

                                                @elseif($report->status == "viewed")
                                                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Viewed</span>

                                                @elseif($report->status == "solved")
                                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Solved</span>
                                                @else
                                                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">NA</span>
                                                @endif

                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a target="_blank" href="https://maps.google.com/?q={{$report->lat}}, {{$report->long}}" class="text-indigo-600 hover:text-indigo-900 text-xs">View<span class="sr-only">, {{$report->name}}</span></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="whitespace-nowrap px-3 py-4 text-sm text-green-700 text-center">No reports</td>

                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-page-container>

    @pushif(count($reports) > 0, "bottomScripts")

        <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
            ({key: "{{$apiKey}}", v: "beta"});</script>

        <script>
            let map;

            async function initMap() {
                // The location of Uluru
                const position = { lat: 53.3811, lng: 1.4701};
                // Request needed libraries.
                //@ts-ignore
                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

                // The map, centered at Uluru
                map = new Map(document.getElementById("map"), {
                    zoom: 4,
                    center: position,
                    mapId: "PANIC_MAP",
                });

                let markers = @json($reports);

                markers.forEach(function(marker) {
                    console.log("Plotting at: lat: "+marker.lat+" long: "+marker.long)
                    new AdvancedMarkerElement({
                        map: map,
                        position: { lat: marker.lat, lng: marker.long},
                        title: marker.name
                    });
                });

                // Ensure the map contains all the markers
                const bounds = new google.maps.LatLngBounds();
                markers.forEach((marker) => {
                    bounds.extend(new google.maps.LatLng(marker.lat, marker.long))
                })
                map.fitBounds(bounds)




            }

            initMap();

        </script>
    @endpushif
</x-public-layout>


