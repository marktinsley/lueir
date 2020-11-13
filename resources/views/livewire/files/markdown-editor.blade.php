<div>
    <div class="mb-4">
        <div
            class="py-5 px-6 flex justify-end">
            <x-jet-button class="bg-blue-600">
                <svg class="w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Save
            </x-jet-button>
            <x-jet-button class="ml-2" wire:click="$emit('changePath', '{{ $this->folderPath }}')">
                Close
            </x-jet-button>
        </div>
    </div>
    <div class="lg:flex">
        <div class="flex-grow">
            <textarea name="contents"
                      class="w-full rounded p-4"
                      style="height: 80vh"
                      wire:model="contents"
            ></textarea>
        </div>
        <article class="prose prose-lg ml-10 mb-12">
            {!! $this->toHtml() !!}
        </article>
    </div>
</div>
