async function add_event(event, currColor) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let eventRequest = {
        name: event[0].innerHTML,
        color: currColor,
        _token: token
    };
    //const url = '/admin/v1/page/event';
    const url = '/api/v1/events';
    try {
        let response = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify(eventRequest)
        });
        const obj = await response.json();
        console.log(obj.data.id);
        return obj.data.id;
    }
    catch(err) {
        console.log(err);
    }
}
