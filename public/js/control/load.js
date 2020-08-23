const load_page = (url) => {
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if(xhttp.readyState === 4) {
                if(xhttp.status === 200) {
                    resolve(xhttp.response);
                } else {
                    reject("Gagal mengambil data");
                }
            }
        }
        xhttp.open("GET", url, true);
        xhttp.send();
        xhttp.onerror = () => {
            reject("Gagal mengambil data");
        };
    });
}

export default {load_page};