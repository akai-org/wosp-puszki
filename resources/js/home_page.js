
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./pusher_setup');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

const amount_total_in_PLN = document.querySelector("#amount_total_in_PLN")
const amount_PLN = document.querySelector("#amount_PLN")
const amount_USD = document.querySelector("#amount_USD")
const amount_GBP = document.querySelector("#amount_GBP")
const amount_EUR = document.querySelector("#amount_EUR")
const collectors_in_city = document.querySelector("#collectors_in_city")


window.Echo.channel(`box-confirmations`)
    .listen('BoxConfirmed', (e) => {
        const total = e.total
            if (amount_total_in_PLN) amount_total_in_PLN.textContent = total.amount_total_in_PLN
            if (amount_PLN) amount_PLN.textContent = total.amount_PLN
            if (amount_USD) amount_USD.textContent = total.amount_USD
            if (amount_GBP) amount_GBP.textContent = total.amount_GBP
            if (amount_EUR) amount_EUR.textContent = total.amount_EUR
            if (collectors_in_city) collectors_in_city.textContent = total.collectors_in_city
});