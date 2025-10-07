<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Configuration and Initial Values ---
    const API_BASE = '/api';

    // Blade templates inject the old request values for repopulation
    const oldValues = {
        division: '{{ request('division') }}',
        district: '{{ request('district') }}',
        upazila: '{{ request('upazila') }}',
    };

    // --- DOM Elements ---
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    // --- Utility Functions ---

    /**
     * Sets the loading state for a select element.
     * @param {HTMLSelectElement} element - The select element to update.
     * @param {boolean} isLoading - True to set loading state, false to remove.
     * @param {string} text - The text to display in the option while loading.
     */
    const setLoading = (element, isLoading, text = 'Loading...') => {
        if (isLoading) {
            element.disabled = true;
            element.innerHTML = `<option value="" disabled selected>${text}</option>`;
        } else {
            element.disabled = false;
        }
    };

    /**
     * Shows an error and updates the select element.
     * @param {HTMLSelectElement} element - The select element that failed.
     * @param {string} message - The error message.
     */
    const handleLoadError = (element, message) => {
        console.error('Location dropdown error:', message);
        element.innerHTML = '<option value="" disabled selected>Error loading data</option>';
        setLoading(element, false);
    };

    /**
     * Common fetch and JSON parsing logic.
     * @param {string} url - The API endpoint URL.
     * @returns {Promise<Array<string>>} - A promise that resolves with the data array.
     */
    const fetchData = async (url) => {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (!Array.isArray(data) || data.length === 0) {
            throw new Error('No data found for this selection.');
        }
        return data;
    };


    // --- Core Logic Functions ---

    /**
     * Populates a select element with new options.
     * @param {HTMLSelectElement} element - The select element to populate.
     * @param {string[]} data - Array of option values (and text).
     * @param {string} defaultText - The text for the "All" option.
     * @param {string} [oldValue] - The value to pre-select, if it matches.
     */
    const populateSelect = (element, data, defaultText, oldValue) => {
        let optionsHtml = `<option value="">${defaultText}</option>`;
        let valueToSelect = '';

        data.forEach(item => {
            const isSelected = item === oldValue;
            optionsHtml += `<option value="${item}" ${isSelected ? 'selected' : ''}>${item}</option>`;
            if (isSelected) {
                valueToSelect = item;
            }
        });

        element.innerHTML = optionsHtml;
        setLoading(element, false);
        
        // This ensures the browser respects the 'selected' attribute or falls back
        if (valueToSelect) {
            element.value = valueToSelect;
        }
        
        // If the element has a pre-selected value, fire its change event to trigger the next load
        if (element.value && element.value !== '') {
             element.dispatchEvent(new Event('change'));
        }
    };

    /**
     * Loads districts based on the selected division.
     * @param {string} division - The selected division name.
     */
    const loadDistricts = async (division) => {
        // Reset subsequent dropdowns
        districtSelect.innerHTML = '<option value="">All Districts</option>';
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';

        if (!division) {
            return;
        }

        setLoading(districtSelect, true, 'Loading districts...');

        try {
            const url = `${API_BASE}/districts/${encodeURIComponent(division)}`;
            const districts = await fetchData(url);
            
            // Only use the oldDistrict value if we are still on the original oldDivision
            const districtToSelect = division === oldValues.division ? oldValues.district : null;

            populateSelect(districtSelect, districts, 'All Districts', districtToSelect);

        } catch (error) {
            handleLoadError(districtSelect, `Error loading districts: ${error.message}`);
        }
    };

    /**
     * Loads upazilas based on the selected district.
     * @param {string} district - The selected district name.
     */
    const loadUpazilas = async (district) => {
        // Reset subsequent dropdowns
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';

        if (!district) {
            return;
        }

        setLoading(upazilaSelect, true, 'Loading upazilas...');

        try {
            const url = `${API_BASE}/upazilas/${encodeURIComponent(district)}`;
            const upazilas = await fetchData(url);
            
            // Only use the oldUpazila value if we are still on the original oldDistrict
            const upazilaToSelect = district === oldValues.district ? oldValues.upazila : null;

            populateSelect(upazilaSelect, upazilas, 'All Upazilas', upazilaToSelect);
            
        } catch (error) {
            handleLoadError(upazilaSelect, `Error loading upazilas: ${error.message}`);
        }
    };


    // --- Event Listeners ---

    divisionSelect.addEventListener('change', (e) => {
        loadDistricts(e.target.value);
    });

    districtSelect.addEventListener('change', (e) => {
        loadUpazilas(e.target.value);
    });

    // --- Initialization ---

    /**
     * Initializes the dropdowns on page load based on request data.
     */
    const initializeDropdowns = () => {
        // Set the initial division value if it was provided
        if (oldValues.division) {
            divisionSelect.value = oldValues.division;
            
            // Since division is already set, we start the cascade by loading districts.
            // loadDistricts will handle selecting the old district and triggering loadUpazilas.
            loadDistricts(oldValues.division);
        }
        
        // Disable subsequent dropdowns until the parent is selected
        if (!divisionSelect.value) {
            districtSelect.disabled = true;
            upazilaSelect.disabled = true;
        }
    };
    
    // Start the whole process
    initializeDropdowns();
});
</script>