<template>
        <button class="red">1</button>
        <button class="blue">2</button>
        <button class="green">3</button>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return{
            target: '',
            message:[],
            inputed: '',
            randomID: Math.random().toString().split('.')[1]
        }
    },
    created () {
        const defineID = Math.random().toString().split('.')[1];
        this.randomID = defineID;
        Echo.channel(`${defineID}`)
        .listen('MessageNotification', (event) => {
            // do what you need to do based on the event name and data
            console.log(event.message)
            this.message.push(event.message);
            this.setFocus(event.message);
        });
    },
    methods: {
        runCmd() {
            this.target = this.target.length > 0 ? '' : 'notification';
        },
        async sendMessage() {
            const request = await axios.post('/message', {data: this.inputed, ID: this.randomID});
            this.inputed = '';
        },
        setFocus(value) {
            const unit = document.querySelector(`.${value}`);
            if (unit) {
                unit.classList.toggle('select');
            }
        }
    }
}
</script>

<style lang="scss">
    
</style>