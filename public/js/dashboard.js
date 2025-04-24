fetch('load_dashboard.php')
  .then(response => response.json())
  .then(data => {

    const treinoTable = document.querySelector("tbody");
    treinoTable.innerHTML = "";
    data.treinos.forEach(item => {
      const [dia, exercicio, duracao] = item.split(" - ");
      treinoTable.innerHTML += `
        <tr>
          <td>${dia}</td>
          <td>${exercicio}</td>
          <td>${duracao}</td>
        </tr>`;
    });

    const objetivosList = document.querySelector(".list-group");
    objetivosList.innerHTML = "";
    data.objetivos.forEach(obj => {
      const className = obj.concluido ? "completed" : "";
      const badge = obj.concluido ? "success" : "secondary";
      const estado = obj.concluido ? "Feito" : "Pendente";
      objetivosList.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-center ${className}">
          ${obj.descricao}
          <span class="badge bg-${badge}">${estado}</span>
        </li>`;
    });
  });
