var ctxBounceRate=document.querySelector(id);new Chart(ctxBounceRate,{type:"line",data:{labels:labels,datasets:[{label:label,data:data,borderWidth:2,backgroundColor:backgroundColor,borderColor:borderColor,pointStyle:"circle",pointRadius:2,pointHoverRadius:5}]},options:{responsive:!0,plugins:{title:{display:!0,text:text},legend:{display:!1},tooltip:{callbacks:{label:function(e){return e.dataset.label+": "+(e.formattedValue||0)+"%"}}}},interaction:{mode:"index",intersect:!1},scales:{y:{display:!0,ticks:{beginAtZero:!0,stepSize:20,callback:function(e,t,a){return e+"%"}}}}}});