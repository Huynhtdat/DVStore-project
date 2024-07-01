document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('city').addEventListener('change', function() {
        let cityId = this.value;
        if (cityId) {
            fetch('/api/districts/' + cityId)
                .then(response => response.json())
                .then(data => {
                    let districtSelect = document.getElementById('district');
                    districtSelect.innerHTML = '<option value="">Chọn quận, huyện</option>';
                    data.forEach(district => {
                        districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                    });
                })
                .catch(error => console.error('Error fetching districts:', error));
        }
    });

    document.getElementById('district').addEventListener('change', function() {
        let districtId = this.value;
        if (districtId) {
            fetch('/api/wards/' + districtId)
                .then(response => response.json())
                .then(data => {
                    let wardSelect = document.getElementById('ward');
                    wardSelect.innerHTML = '<option value="">Chọn phường, xã</option>';
                    data.forEach(ward => {
                        wardSelect.innerHTML += `<option value="${ward.id}">${ward.name}</option>`;
                    });
                })
                .catch(error => console.error('Error fetching wards:', error));
        }
    });
});
