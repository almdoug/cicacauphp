@extends('layouts.admin')

@section('page-title', 'Editar ' . ucfirst($page))

@section('header-actions')
    <button 
        type="submit" 
        form="edit-form"
        class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-primary text-white rounded-lg text-xs sm:text-sm font-semibold hover:bg-opacity-90 transition-all shadow hover:shadow-md"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="hidden sm:inline cursor-pointer">Salvar</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Form -->
    <form id="edit-form" method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach($contents as $section => $items)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-200">
                    <h4 class="text-base sm:text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $section) }}</h4>
                </div>
                <div class="p-4 sm:p-6 space-y-4">
                    @foreach($items as $item)
                        <div>
                            <label for="{{ $section }}_{{ $item->key }}" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2 capitalize">
                                {{ str_replace('_', ' ', $item->key) }}
                            </label>
                            
                            @if($item->type === 'html')
                                <div class="mb-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                    <p class="text-xs text-blue-800 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Editor HTML - Use para conteúdo formatado e estruturado
                                    </p>
                                </div>
                                <textarea 
                                    id="{{ $section }}_{{ $item->key }}"
                                    name="contents[{{ $section }}][{{ $item->key }}]"
                                    rows="10"
                                    class="tinymce-editor w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-300 rounded-lg"
                                >{{ $item->value }}</textarea>
                            @elseif($item->type === 'textarea')
                                <textarea 
                                    id="{{ $section }}_{{ $item->key }}"
                                    name="contents[{{ $section }}][{{ $item->key }}]"
                                    rows="4"
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                >{{ $item->value }}</textarea>
                            @else
                                <input 
                                    type="text" 
                                    id="{{ $section }}_{{ $item->key }}"
                                    name="contents[{{ $section }}][{{ $item->key }}]"
                                    value="{{ $item->value }}"
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                >
                            @endif
                            
                            @if($item->key === 'button_link')
                                <p class="mt-1 text-xs sm:text-sm text-gray-500">URL do link (ex: /mercado, https://exemplo.com)</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 sm:gap-4 bg-white rounded-lg shadow p-4 sm:p-6">
            <a href="{{ route('admin.dashboard') }}" class="px-4 sm:px-6 py-2 sm:py-3 border border-gray-300 text-gray-700 rounded-lg text-sm sm:text-base font-medium hover:bg-gray-50 transition-colors text-center">
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg text-sm sm:text-base font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl cursor-pointer"
            >
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Preview Link -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div class="flex items-start sm:items-center gap-2 sm:gap-3">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5 sm:mt-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs sm:text-sm text-blue-800">Após salvar, visualize as alterações no site público</span>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 font-medium whitespace-nowrap flex-shrink-0">
            Ver página →
        </a>
    </div>
</div>
@endsection

@push('scripts')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/6hy9a8w8irye827ucmizakpfyrwen5do5rdttukpsqtlsuyw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    function initTinyMCE() {
        if (typeof tinymce === 'undefined') {
            return;
        }
        
        const textareas = document.querySelectorAll('.tinymce-editor');
        if (textareas.length === 0) {
            return;
        }
        
        tinymce.remove();
        
        tinymce.init({
            selector: '.tinymce-editor',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | code',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
            language: 'pt_BR',
            branding: false,
            promotion: false
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initTinyMCE, 500);
        });
    } else {
        setTimeout(initTinyMCE, 500);
    }
</script>
@endpush
