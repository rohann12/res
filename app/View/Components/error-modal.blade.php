<!-- Error Modal -->
<div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-red-600">Error</h3>
            <button id="closeErrorModal" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        <div class="text-gray-800">
            {{ $message ?? 'An unknown error occurred.' }}
        </div>
        <div class="mt-4 text-right">
            <button id="closeErrorModalButton" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>
</div>
