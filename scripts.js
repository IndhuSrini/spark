document.addEventListener('DOMContentLoaded', () => {
    const techEvents = document.querySelectorAll('.tech-event');
    const nonTechEvents = document.querySelectorAll('.non-tech-event');

    techEvents.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const anyTechChecked = Array.from(techEvents).some(event => event.checked);
            nonTechEvents.forEach(nonTech => {
                nonTech.disabled = !anyTechChecked;
            });
        });
    });

    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const whatsapp = document.getElementById('whatsapp').value;
        alert(`Registered successfully!\nName: ${name}\nEmail: ${email}\nWhatsApp: ${whatsapp}`);
    });
});
