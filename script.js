// script.js

// Sample data for promotions
const promotionsData = [
    {
        image: 'promotion1.jpg',
        title: 'Special Weekend Buffet',
        description: 'Indulge in a delightful buffet with a variety of cuisines every weekend.'
    },
    {
        image: 'promotion2.jpg',
        title: 'Early Bird Discounts',
        description: 'Enjoy exclusive discounts on early reservations from Monday to Thursday.'
    },
    // Add more promotions as needed
];

// Function to initialize the promotional slider
function initPromotionalSlider() {
    const sliderContainer = document.getElementById('promotionsContainer');

    function showSlide() {
        const promotion = promotionsData.shift();
        promotionsData.push(promotion);

        const promotionCard = `
            <div class="promotion-card">
                <img src="${promotion.image}" alt="${promotion.title}">
                <h3>${promotion.title}</h3>
                <p>${promotion.description}</p>
            </div>
        `;

        // Remove the previous slide
        sliderContainer.innerHTML = '';
        sliderContainer.insertAdjacentHTML('beforeend', promotionCard);

        // Set a timeout for the next slide
        setTimeout(showSlide, 5000); // Change 5000 to the desired interval in milliseconds (e.g., 5000 for 5 seconds)
    }

    // Start the slider
    showSlide();
}

// Call the function to initialize the promotional slider
initPromotionalSlider();
