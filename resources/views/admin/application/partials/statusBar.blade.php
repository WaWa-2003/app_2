<section>
    @if ($opportunity_id)
        <div class="flex justify-center items-center my-4 gap-1">
            @foreach (['All', 'New', 'Prescreen', 'First Interview', 'Second Interview', 'Third Interview', 'Offer', 'Accept', 'Reject', 'Not Suitable'] as $statusNav)
                <a href="{{ route('application.opportunity.show.' . strtolower(str_replace(' ', '', $statusNav)), $opportunity_id) }}">
                    @if ($status == $statusNav || ($statusNav == 'All' && is_null($status)))
                        <x-primary-button data-status="{{ $statusNav }}">
                            {{ $statusNav }} ({{ $countsStatusBarArray[$statusNav] }})
                        </x-primary-button>
                    @else
                        <x-secondary-button data-status="{{ $statusNav }}">
                            {{ $statusNav }} ({{ $countsStatusBarArray[$statusNav] }})
                        </x-secondary-button>
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="flex justify-center items-center my-4 gap-1">
            @foreach (['All', 'New', 'Prescreen', 'First Interview', 'Second Interview', 'Third Interview', 'Offer', 'Accept', 'Reject', 'Not Suitable'] as $statusNav)

            <a href="{{ route('application.status', $statusNav) }}">
                @if ($status == $statusNav || ($statusNav == 'All' && is_null($status)))
                    <x-primary-button data-status="{{ $statusNav }}">
                        {{ $statusNav }} ({{ $countsStatusBarArray[$statusNav] }})
                    </x-primary-button>
                @else
                    <x-secondary-button data-status="{{ $statusNav }}">
                        {{ $statusNav }} ({{ $countsStatusBarArray[$statusNav] }})
                    </x-secondary-button>
                @endif
            </a>

            @endforeach
        </div>
    @endif
</section>
