@props(['title', 'subtitle', 'backLink' => null, 'backText' => ''])
<div class="flex flex-col text-center w-full mb-12">

  @if($backLink)
    <!--Back-->
    <div class="text-left">
      <x-link-button href="{{$backLink}}"  class="btn-ghost font-normal text-left">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        <span>{{$backText}}</span>
      </x-link-button>
    </div>
  @endif

  <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{$title}}</h1>
  <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{$subtitle}}</p>
</div>