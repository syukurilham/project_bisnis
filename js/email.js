// Pastikan untuk mengganti 'YOUR_USER_ID', 'YOUR_SERVICE_ID', dan 'YOUR_TEMPLATE_ID' dengan nilai yang sesuai dari EmailJS
const userID = 'cE3KcEH0RcRO5YQsC';
const serviceID = 'service_wd50cu9';
const templateID = 'template_5gj88eo';

// Fungsi untuk mengirim email
function sendEmail(event) {
    event.preventDefault(); // Mencegah pengiriman formulir secara default

    // Mengambil nilai dari formulir
    const firstName = document.getElementById('contact-first-name').value;
    const lastName = document.getElementById('contact-last-name').value;
    const email = document.getElementById('contact-email').value;
    const message = document.getElementById('contact-message').value;

    // Mengatur data untuk dikirim
    const templateParams = {
        from_name: `${firstName} ${lastName}`,
        from_email: email,
        message: message,
    };

    // Mengirim email menggunakan EmailJS
    emailjs.send(serviceID, templateID, templateParams, userID)
        .then((response) => {
            console.log('SUCCESS!', response.status, response.text);
            alert('Pesan Anda telah dikirim!');
        }, (error) => {
            console.error('FAILED...', error);
            alert('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        });
}

// Menambahkan event listener pada formulir
document.querySelector('.rd-mailform').addEventListener('submit', sendEmail);
