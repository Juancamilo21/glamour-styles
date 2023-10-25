function formatCOP(value) {
  return new Intl.NumberFormat("es-CO", {
    currency: "COP",
    style: "currency",
    minimumFractionDigits: 2,
  }).format(value);
}
