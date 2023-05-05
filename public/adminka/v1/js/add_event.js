function add_event(event, currColor){
    // let url = '/admin/v1/page/event';
    let url = '/api/v1/events';
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            name: event[0].innerHTML,
            color: currColor,
            _token: token
        })
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
    }).then((data) => {
    }).catch(function (error) {
        console.log(error);
    });
}
