<template>
    <div>
        <button class="red">1</button>
        <button class="blue">2</button>
        <button class="green">3</button>
    </div>
    
    <p>{{target}}</p>
    <button @click="runCmd">Exe</button>
    <div v-for="item in message">
        <p>{{item}}</p>
    </div>
    <div>
        <input type="text" v-model="inputed">
        <button @click="sendMessage">SEND</button>
    </div>
    {{ randomID }}
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
    button {
        border: none;
        width: 200px;
        font-size: 20px;
        cursor: pointer;
        margin: 5px;
        &:hover {
            filter: brightness(50%);
        }
    }
    .red {
        background-color: crimson;
    }
    .blue {
        background-color: skyblue;
    }
    .green {
        background-color: lime;
    }
    .select {
        position: relative;
        border: 2px solid red;
        &::after {
            content: '\f062'; 
            font-family: 'Font Awesome 5 Free'; 
            font-weight: 900; /* Adjust font-weight as needed */
            margin-right: 5px; /* Optional: Add some spacing */
            color: red;
            position: absolute;
            bottom:0;
            left: 50%;
            transform: translate(-50%, 100%);
            font-size: 50px;
            animation: arrow 1s ease-in infinite alternate;
        }
    }
    @keyframes arrow {
        from {
            bottom: -60;
        }
        to {
           bottom: 0;
        }
    }
</style>