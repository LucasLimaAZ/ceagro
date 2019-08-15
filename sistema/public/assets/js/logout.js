localStorage.removeItem('usuarioLogado');
$.get('../back-end/logout').done(() => window.location.href = 'index.php');