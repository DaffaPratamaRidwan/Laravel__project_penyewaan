// document.addEventListener('DOMContentLoaded', function() {
//     function showToast(type, message) {
//         const toast = document.getElementById(`toast-${type}`);
//         if (toast) {
//             toast.querySelector('.font-normal').textContent = message;
//             toast.classList.remove('hidden');
//             setTimeout(() => {
//                 toast.classList.add('hidden');
//             }, 5000); // Notifikasi akan hilang setelah 5 detik
//         }
//     }

//     // Menampilkan notifikasi jika ada
//     const successMessage = window.toastMessages.success;
//     const errorMessage = window.toastMessages.error;
//     const warningMessage = window.toastMessages.warning;

//     if (successMessage) {
//         showToast('success', successMessage);
//     }

//     if (errorMessage) {
//         showToast('danger', errorMessage);
//     }

//     if (warningMessage) {
//         showToast('warning', warningMessage);
//     }
// });
