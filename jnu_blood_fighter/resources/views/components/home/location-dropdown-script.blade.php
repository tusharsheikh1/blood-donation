<script>
document.addEventListener('DOMContentLoaded', function() {
    const oldDivision = '{{ request('division') }}';
    const oldDistrict = '{{ request('district') }}';
    const oldUpazila = '{{ request('upazila') }}';

    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    function setLoading(element, isLoading, text = 'Loading...') {
        if (isLoading) {
            element.disabled = true;
            element.innerHTML = `<option value="">${text}</option>`;
        } else {
            element.disabled = false;
        }
    }

    function showError(message) {
        console.error(message);
    }

    divisionSelect.addEventListener('change', function() {
        const division = this.value;
        loadDistricts(division);
    });

    districtSelect.addEventListener('change', function() {
        const district = this.value;
        loadUpazilas(district);
    });

    function loadDistricts(division) {
        districtSelect.innerHTML = '<option value="">All Districts</option>';
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
        
        if (!division) {
            return;
        }

        setLoading(districtSelect, true, 'Loading districts...');
        
        fetch(`/api/districts/${encodeURIComponent(division)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                    throw new Error('No districts found for this division');
                }

                districtSelect.innerHTML = '<option value="">All Districts</option>';
                data.forEach(district => {
                    const option = new Option(district, district, false, district === oldDistrict);
                    districtSelect.add(option);
                });
                
                setLoading(districtSelect, false);

                if (oldDistrict && divisionSelect.value === oldDivision) {
                    districtSelect.value = oldDistrict;
                    loadUpazilas(oldDistrict);
                }
            })
            .catch(error => {
                showError('Error loading districts: ' + error.message);
                districtSelect.innerHTML = '<option value="">Error loading districts</option>';
                setLoading(districtSelect, false);
            });
    }

    function loadUpazilas(district) {
        upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
        
        if (!district) {
            return;
        }

        setLoading(upazilaSelect, true, 'Loading upazilas...');
        
        fetch(`/api/upazilas/${encodeURIComponent(district)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                    throw new Error('No upazilas found for this district');
                }

                upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';
                data.forEach(upazila => {
                    const option = new Option(upazila, upazila, false, upazila === oldUpazila);
                    upazilaSelect.add(option);
                });
                
                setLoading(upazilaSelect, false);

                if (oldUpazila && districtSelect.value === oldDistrict) {
                    upazilaSelect.value = oldUpazila;
                }
            })
            .catch(error => {
                showError('Error loading upazilas: ' + error.message);
                upazilaSelect.innerHTML = '<option value="">Error loading upazilas</option>';
                setLoading(upazilaSelect, false);
            });
    }

    // Initialize on page load
    if (oldDivision) {
        loadDistricts(oldDivision);
    }
});
</script>