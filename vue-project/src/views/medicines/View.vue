<template>
    <div class="container">
        <p></p>
    </div>
    <div class=" container card" style="position: absolute;right: 52px;width: 1000px; background-color:rgb(84, 202, 131)" >
        <div class="card-header">
            <h4 class="container " style="background-color: gray;height: 50px; text-align: center;">
                Liste des Medecine
                  <RouterLink to="/medicines/create" class="btn btn-primary float-end">Ajout</RouterLink>
            </h4>
        </div>
        <div class="  card-body">
            <table class="table table-bordered">
                <thead style="background-color: rgb(31, 45, 45); color: white;font-size: 14px; text-align: center;">
                    <tr style="background-color: rgb(39, 121, 193); color: aliceblue;">
                        <th style="background-color: rgb(39, 121, 193); color: aliceblue;">Numero medicine</th>
                        <th style="background-color: rgb(39, 121, 193); color: aliceblue;">Nom</th>
                        <th style="background-color: rgb(39, 121, 193); color: aliceblue;">Nombre de jours</th>
                        <th style="background-color: rgb(39, 121, 193); color: aliceblue;">Prestation</th>
                        <th style="background-color: rgb(39, 121, 193); color: aliceblue;">Action</th>
                    </tr>
                </thead>
                <tbody style="text-align: center ;">
                    <tr v-for="(medicine, index) in this.medicines" :key="index">
                        <td>{{ medicine.id }}</td>
                        <td>{{ medicine.nom }}</td>
                        <td>{{ (medicine.jour )}}</td>
                        <td>{{ calculerPrestation(medicine) }}</td>
                        <td>
                            <td>
                                <RouterLink :to="{path:'/medicines/'+ medicine.id+'/edit'}" class="btn btn-primary mx-2">edit</RouterLink>
                            </td>
                            
                           <td> <button type="button" @click="deletemed(medicine.id)" class="btn btn-danger mx-2" style="color: black;">Delete</button></td>
                        </td>
                    </tr>
                    
                </tbody>
                
            </table>
            <div>
        <h5 style="text-align: center;"> Prestation total :{{ calculerTotalPrestations }}</h5>
        <h5 style="text-align: center;"> Prestation Minimal :{{ calculerPrestationMin }}</h5>
        <p style="text-align: center;"><h5>Prestation Maximal:{{ calculerPrestationMax }}</h5></p>
    </div>
        </div>
    </div>
    <div>
       
    </div>
    <div>
        <h3></h3>
    </div>
  </template> 
  <script>
  import axios from 'axios';
import { computed } from 'vue';
    export default{
        name:'medicines',
        data(){
            return{
                medicines:[]
            }
        },
        mounted(){
            console.log('i am ee');
            this.getmedicines();
            //this.calculerTotalPrestations();
        },
        methods:{
            calculerPrestation(medicine) {
            return medicine.jour * medicine.taux;
        },
        
            getmedicines(){
                axios.get('http://127.0.0.1:8000/api/medicines').then(res=>{
                    this.medicines = res.data.medicines
                    console.log(this.medicines )
                });
            },
            deletemed(medID){
                console.log(medID)
                if(confirm('Vous avez suprimer !')){
                    console.log(medID)
                }
                axios.delete(`http://127.0.0.1:8000/api/medicines/${medID}/delete`).then(res=>{
                    alert(res.data.message);
                    this.getmedicines();
                }).catch(function (error){
                        if(error.response){
                            if(error.response.status ==404){
                                alert(error.response.data.message);
                            }
                        }
                    })
            }
        },
        computed:{
        calculerTotalPrestations: function() {
            return this.medicines.reduce((total, medicine) => total + medicine.jour * medicine.taux, 0);
        },

        calculerPrestationMin: function() {
            return Math.min(...this.medicines.map(medicine => medicine.jour * medicine.taux));
        },

        calculerPrestationMax: function() {
            return Math.max(...this.medicines.map(medicine => medicine.jour * medicine.taux));
        } 
        },
    }
    
</script>
