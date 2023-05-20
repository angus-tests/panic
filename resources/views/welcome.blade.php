<x-public-layout>
    <x-page-container>
        <x-page-title title="Welcome to Panic" subtitle="A panic reporting website" />

        <div>

            <p>Reports...</p>
            <ul>
                @foreach($reports as $report)
                    <li>{{$report}}</li>
                @endforeach
            </ul>
        </div>
    </x-page-container>
</x-public-layout>
