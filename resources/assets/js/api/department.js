// Imports the Roast API URL from the config.
import { ROAST_CONFIG } from '../config.js';

export default {
    // GET => /api/programming/dp
    dpIndex: function(){
        return axios.get(ROAST_CONFIG.API_URL + '/programming/dp');
    },
    // POST => /api/programming/dp
    dpStore: function(name, description){
        return axios.post(ROAST_CONFIG.API_URL + '/programming/dp', {
            name: name,
            description: description
        });
    },
    // GET => /api/programming/dp/{id}
    dpShow: function(id){
        return axios.get(ROAST_CONFIG.API_URL + '/programming/dp/' + id);
    },
    // PUT => /api/programming/dp
    dpUpdate: function(name, description, id){
        return axios.put(ROAST_CONFIG.API_URL + '/programming/dp/' + id, {
            name: name,
            description: description
        });
    },
    // DELETE => /api/programming/dp/{id}
    dpDestroy: function(id){
        return axios.delete(ROAST_CONFIG.API_URL + '/programming/dp/' + id);
    },
}