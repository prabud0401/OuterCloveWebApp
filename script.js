document.addEventListener('DOMContentLoaded', function () {
    // Fetch promotions from JSON file
    fetch('data.json')
        .then(response => response.json())
        .then(data => {
            // Display promotions
            displayPromotions(data.promotions);
        })
        .catch(error => console.error('Error fetching data:', error));

    // Function to display promotions
    function displayPromotions(promotions) {
        const promotionsContainer = document.getElementById('promotionsContainer');

        promotions.forEach(promotion => {
            const promotionCard = createPromotionCard(promotion);
            promotionsContainer.appendChild(promotionCard);
        });
    }

    // Function to create a promotion card
    function createPromotionCard(promotion) {
        const promotionCard = document.createElement('div');
        promotionCard.className = 'promotion-card';

        const image = document.createElement('img');
        image.src = promotion.image;
        image.alt = promotion.title;

        const title = document.createElement('h3');
        title.textContent = promotion.title;

        const description = document.createElement('p');
        description.textContent = promotion.description;

        promotionCard.appendChild(image);
        promotionCard.appendChild(title);
        promotionCard.appendChild(description);

        return promotionCard;
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const userType = document.getElementById('user-type').value;

        // Fetch users from JSON file
        fetch('users.json')
            .then(response => response.json())
            .then(data => {
                const users = data.users;
                const user = users.find(u => u.username === username && u.password === password && u.role === userType);

                if (user) {
                    // Store user information in session storage
                    sessionStorage.setItem('loggedInUser', JSON.stringify(user));

                    alert(`Welcome, ${user.role} ${user.username}!`);

                    // Redirect to the respective dashboard
                    redirectToDashboard(userType);
                } else {
                    alert('Invalid username, password, or user type. Please try again.');
                }
            })
            .catch(error => console.error('Error fetching user data:', error));
    });


    // Function to redirect to the respective dashboard
    function redirectToDashboard(userType) {
        switch (userType) {
            case 'admin':
                window.location.href = 'admin-dashboard.html';
                break;
            case 'staff':
                window.location.href = 'staff-dashboard.html';
                break;
            case 'customer':
                window.location.href = 'customer-dashboard.html';
                break;
            default:
                break;
        }
    }
});
