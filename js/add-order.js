let id_order_type = 0;
        let id_address = 0;
        let total = 0;

        let currentDate = new Date();

        let day = currentDate.getDate();
        let month = currentDate.getMonth() + 1;
        let year = currentDate.getFullYear();
        let hours = currentDate.getHours();
        let minutes = currentDate.getMinutes();
        let seconds = currentDate.getSeconds();

        let formattedDate = `${year}/${month}/${day}`;
        let formattedTime = `${hours}:${minutes}:${seconds}`;

        function getIdOrder(order_type_id) {
            id_order_type = order_type_id;
            console.log(id_order_type);
        }

        function getIdAddress(address_id) {
            id_address = address_id;
            console.log(address_id);
        }

        function addOrder(id_user) {

            let info = {
                id_user: id_user,
                id_order_type: id_order_type,
                id_address: id_address,
                date: formattedDate,
                time: formattedTime,
                total: total
            };

            console.log(info);

            // Fetch
            fetch("http://localhost/gasthof-backend/AJAX/add-order.php", {
                    method: "POST",
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        'Accept': "application/json, text/plain, */*",
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(info)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let id_order = data[0].id_order;
                    document.getElementById("complete-order").setAttribute("href", 'confirmation.php?id='+id_order);
                    window.location.href = "http://localhost/gasthof-backend/confirmation.php?id=" + id_order;
                })
                .catch(err => console.log("Error al enviar la solicitud: " + err));
        }