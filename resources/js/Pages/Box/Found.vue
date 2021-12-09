<template>

    <Head title="Welcome" />

    <h4>Znaleziono puszkę {{ box.id }}</h4>
    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <td>Wolontariusz</td>
            <td>{{ collector.firstName }} {{ collector.lastName }}</td>
        </tr>
        <tr>
            <td>Numer identyfikatora i na puszce</td>
            <td>{{ collector.identifier }}</td>
        </tr>
        @if(Auth::user()->hasAnyRole(['admin', 'superadmin']))
        {{$page.props.auth.user}}
        <tr>
            <td>ID puszki w bazie</td>
            <td>{{ box.id }}</td>
            @endif
        </tr>
        </tbody>
    </table>
    <ul style="text-align: center; font-size: 2em;list-style-type: none;">
        <li>Potwierdź, że dane z puszki i identyfikatora są zgodne z wyświetlonymi.</li>
        <li>Potwierdź, że puszka nie nosi śladów uszkodzeń.</li>
        <li>Nie oddawaj rozliczonej puszki wolontariuszowi.</li>
    </ul>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <form @submit.prevent="submit" class="form-horizontal">
                <fieldset>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="control-label" for="singlebutton">Zgodność z danymi rzeczywistymi</label><br>
                        <div class="">
                            <jet-button class="ml-4" id="singlebutton" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Potwierdzam
                            </jet-button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</template>

<script>

import { Head } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';

export default {
    name: 'Box/Found',
    components: {
        Head,
        JetButton

    },
    props: {
        box: Object,
        collector: Object
    },
    mounted() {
        console.log(this.$page.props);
    },
    data() {
        return {
            form: this.$inertia.form({
                boxID: this.$props.box.id
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('box.findConfirm'));
        }
    }
}
</script>
