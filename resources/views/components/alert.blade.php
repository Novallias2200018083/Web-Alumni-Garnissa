@props(['type', 'message'])

@php
    $class = '';
    switch ($type) {
        case 'success':
            $class = 'bg-green-100 border-green-500 text-green-700';
            break;
        case 'danger':
        case 'error':
            $class = 'bg-red-100 border-red-500 text-red-700';
            break;
        case 'warning':
            $class = 'bg-yellow-100 border-yellow-500 text-yellow-700';
            break;
        case 'info':
            $class = 'bg-blue-100 border-blue-500 text-blue-700';
            break;
        default:
            $class = 'bg-gray-100 border-gray-500 text-gray-700';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded-md border-l-4 mb-4 " . $class]) }} role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            @if($type === 'success')
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.857a.75.75 0 00-1.214-.886l-3.232 3.232a.75.75 0 00-1.214-.886l-1.214 1.214a.75.75 0 001.06 1.06l1.768-1.768 2.724 2.724a.75.75 0 001.06-1.06z" clip-rule="evenodd" />
                </svg>
            @elseif($type === 'danger' || $type === 'error')
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94l-1.72-1.72z" clip-rule="evenodd" />
                </svg>
            @elseif($type === 'info' || $type === 'warning')
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.25 1.25 0 0010.75 15h.25a.75.75 0 000-1.5h-.25a.25.25 0 01-.244-.304l.459-2.066A1.25 1.25 0 009.25 9H9z" clip-rule="evenodd" />
                </svg>
            @endif
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium">{{ $message }}</p>
        </div>
    </div>
</div>