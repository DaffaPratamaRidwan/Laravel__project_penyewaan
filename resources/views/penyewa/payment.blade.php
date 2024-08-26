
@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pl-40">
        <!-- Main Content -->
        <div class="col-span-1 md:col-span-3 p-6 bg-white shadow-md rounded-md border-custom shadow-custom mb-10">
            <form id="paymentForm" action="{{ route('penyewa.sewa.payment.store', $sewa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-900">Form Pembayaran</h2>
                    <!-- Countdown Timer -->
                    <div id="countdown" class="text-red-600 text-lg font-bold">02:00:00</div>
                    <a class="block text-xs text-red-600 max-w-xs break-words">*jika tidak mengkonfirmasi pembayaran selama 2 jam maka penyewaan akan dibatalkan</a>

                    <!-- Total Nominal -->
                    <div class="pt-8 pb-4">
                        <label for="total_nominal" class="block text-sm font-medium text-gray-700">Total Nominal: Rp {{ $totalHargaFormatted }}</label>
                    </div>

                    <!-- Transfer Ke Mana -->
                    <div class="border-t border-gray-200 pt-8 pb-4">
                        <label for="transfer_kemana" class="block text-sm font-medium text-gray-700">Transfer To: 923123221 BCA a.n ucup</label>
                    </div>

                    <!-- Bukti Bayar -->
                    <div class="border-t border-gray-200 pt-8">
                        <label for="bukti_bayar" class="block text-sm font-medium text-gray-700 pb-2">Bukti Bayar</label>
                        <input type="file" id="bukti_bayar" name="bukti_bayar" required
                            class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 mt-4">
                        <!-- <a href="{{ route('penyewa.dashboard') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:bg-gray-300">Batal</a> -->
                        
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Bayar</button>
                    </div>
                </div>
            </form>
            <div class="flex justify-end mt-2">
                <form action="{{ route('penyewa.sewa.batal', $sewa->id) }}" method="POST">
                    @csrf
                    <button type="submit" id="batal-button" class="px-[22px] py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:bg-gray-300">Batal</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Toast Notification -->
    <div id="toast-notification" class="hidden fixed top-5 right-5 z-100 flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800" role="alert">
        <svg class="w-6 h-6 text-red-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        <div class="ps-4 text-sm font-normal" id="toast-message">Waktu pembayaran telah habis.</div>
    </div>
</div>
<!-- <form action="{{ route('admin.bayar.reject', $sewa->id) }}" class="hover:text-red-500" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Tolak Penyewaan</button>
</form> -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    var countdownElement = document.getElementById('countdown');
    var countdownTime = 7200; 

    function formatTime(seconds) {
        var hrs = Math.floor(seconds / 3600);
        var mins = Math.floor((seconds % 3600) / 60);
        var secs = seconds % 60;
        
        return `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function showToast(message) {
        var toast = document.getElementById('toast-notification');
        var toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;
        toast.style.display = 'flex'; // Ensure the toast is displayed
    }

    function startCountdown() {
        var interval = setInterval(function() {
            countdownElement.textContent = formatTime(countdownTime);
            countdownTime--;

            if (countdownTime < 0) {
                clearInterval(interval);
                showToast('Waktu pembayaran telah habis.');

                // Programmatically click the "Batal" button
                setTimeout(function() {
                    document.getElementById('batal-button').click();
                }, 2000); 
            }
        }, 1000);
    }

    startCountdown();
});
</script>



@endsection
