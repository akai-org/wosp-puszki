window.encodeQueueStatusUpdate = (status, station) => {
    return JSON.stringify({
        s: status,
        st: station,
        t: Math.floor(Date.now() / 1000)
    })
}