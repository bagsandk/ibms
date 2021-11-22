<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
        label: 'Pembayaran terhadap terkontrak',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      },
      {
        label: 'SKKI Terhadap terkontrak',
        backgroundColor: 'rgb(25, 99, 132)',
        borderColor: 'rgb(25, 99, 132)',
        data: [2, 30, 10, 2, 10, 40, 25],
      }
    ]
  };
  const config = {
    type: 'bar',
    data: data,
    options: {}
  }
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
  const myChart1 = new Chart(
    document.getElementById('myChart1'),
    config
  );
  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config
  );
</script>