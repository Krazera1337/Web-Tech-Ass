document.querySelectorAll('.pokemon-trio').forEach(function (card) {
  const page = card.closest('.profile-page');
  const details = page.querySelector('.details-flip-wrapper');
  const map = page.querySelector('.map-card');
  const bush = card.querySelector('.trio-bush');
  const third = card.querySelector('.trio-third');
  if (!details || !map || !bush || !third) return;

  const hosts = [card, details, map];
  for (let i = hosts.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [hosts[i], hosts[j]] = [hosts[j], hosts[i]];
  }
  hosts[0].prepend(bush);
  hosts[1].prepend(third);
  hosts.slice(0, 2).forEach(function (host) {
    host.classList.add('pokemon-decorated');
    if (host !== card && Math.random() < 0.5) host.classList.add('pokemon-decorated-left');
  });
});
