<template>

    <Head title="Welcome" />
    <div class="flex flex-col md:flex items-center justify-around  py-2 px-8 md:px-12">
        <h4 class="text-3xl font-bold mx-4 my-4 text-gray-800 md:text-4xl">Znaleziono puszkę <span class="text-red-700">{{ box.id }}</span></h4>
        <table class="table-fixed w-full text-sm rounded-lg">
            <tbody>
            <tr class="bg-gray-300 rounded-lg">
                <td class="p-6 text-base font-bold tracking-wide text-left">Wolontariusz</td>
                <td class="p-6 text-base text-gray-800">{{ collector.firstName }} {{ collector.lastName }}</td>
            </tr>
            <tr class="bg-white rounded-lg">
                <td class="p-6 text-base font-bold tracking-wide text-left">Numer identyfikatora i na puszce</td>
                <td class="p-6 text-base text-gray-800">{{ collector.identifier }}</td>
            </tr >

            <tr v-if="flag"  class="bg-gray-300 rounded-lg">
                <td class="p-6 text-base font-bold tracking-wide text-left ">ID puszki w bazie</td>
                <td class="p-6 text-base text-gray-800 ">{{ box.id }}</td>
            </tr>
            </tbody>
        </table>


        <div class="bg-white mt-4 rounded-lg w-full shadow-md lg:w-1/3 ">
            <ul class="divide-y divide-gray-100">
                <li class="p-3 hover:text-red-700" >
                    Potwierdź, że dane z puszki i identyfikatora są zgodne z wyświetlonymi.
                </li>
                <li class="p-3 hover:text-red-700">
                    Potwierdź, że puszka nie nosi śladów uszkodzeń.
                </li>
                <li class="p-3 hover:text-red-700">
                    Nie oddawaj rozliczonej puszki wolontariuszowi.
                </li>
            </ul>
        </div>

        <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 my-4">
                    <fieldset>
                        <!-- Button -->
                        <div class="mt-4 mb-4 flex flex-col content-center">
                            <jet-label class="block text-gray-700 text-xl underline underline-offset-8 font-bold mb-2"  for="singlebutton">Zgodność z danymi rzeczywistymi</jet-label>
                            <br>
                            <jet-button class="text-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Potwierdzam
                            </jet-button>
                        </div>
                    </fieldset>
                </form>
    </div>




</template>

<script>

import { Head } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetLabel from '@/Jetstream/Label.vue';

export default {
    name: 'Box/Found',
    components: {
        Head,
        JetButton,
        JetLabel,
    },
    props: {
        box: Object,
        collector: Object,
        flag: Boolean
    },
    mounted() {
        // console.log(this.$page.props);
        this.flag = this.$page.props.auth.user ? true : false;

    },
    data() {
        return {
            form: this.$inertia.form({
                boxID: this.$props.box.id
            }),

        }
    },

    methods: {
        submit() {
            this.form.post(this.route('box.findConfirm'));
        }
    }
}
</script>
