$(function () {

	$.post(
		topMenuUrl,
		{ '_token': csrf },
		function (res) {
			let ctx = document.getElementById('topMenu').getContext('2d')
	    	let chart = new Chart(ctx, {
	    		type: 'pie',
	    		data: {
	    			labels: res.label,
	                datasets: [{
	                    backgroundColor: [
	                       "#5969ff",
	                        "#ff407b",
	                        "#25d5f2",
	                        "#ffc750",
	                        "#2ec551",
	                        "#7040fa",
	                        "#ff004e"
	                    ],
	                    data: res.data
	                }]
	            },
	            options: {
	            	legend: {
		                display: true,
		                position: 'bottom',
		                labels: {
		                    fontColor: '#71748d',
		                    fontFamily: 'Circular Std Book',
		                    fontSize: 14,
		                }
		            }
	            },
	    	})
		}
	)

	$.post(
		totalRevenueUrl,
		{ '_token': csrf },
		function (res) {
			let ctx = document.getElementById('totalRevenue').getContext('2d')
	    	let chart = new Chart(ctx, {
	    		type: 'line',

                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Orders',
                        data: res,

                        backgroundColor: "rgba(89, 105, 255,0.5)",
                        borderColor: "rgba(89, 105, 255,0.7)",
                        borderWidth: 2
                    }]

                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom',

                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },

                    scales: {
                        xAxes: [{
                            ticks: {
                                fontSize: 14,
                                fontFamily: 'Circular Std Book',
                                fontColor: '#71748d',
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                fontSize: 14,
                                fontFamily: 'Circular Std Book',
                                fontColor: '#71748d',
                            }
                        }]
                    }
                }
	    	})
		}
	)
    
})