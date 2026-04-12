<?php
// includes/footer.php
?>
    </main>

    <!-- Footer Estilo Dark Premium -->
    <footer class="bg-black border-t border-lasalle-green/10 py-12 mt-auto">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <!-- Branding -->
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-lasalle-green to-emerald-400 flex items-center justify-center">
                            <i class="fas fa-university text-sm text-black"></i>
                        </div>
                        <p class="font-semibold text-lg text-white">Universidad La Salle</p>
                    </div>
                </div>
                
                <!-- Copyright & Info -->
                <p class="text-gray-400 text-sm text-center md:text-left">
                    &copy; <?php echo date("Y"); ?> Universidad La Salle • 
                    <span class="block md:inline">Actividad Arquitectura de Software</span>
                </p>

                <!-- Social Links -->
                <div class="flex gap-6 text-xl">
                    <a href="#" class="text-gray-400 hover:text-lasalle-green transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-lasalle-green transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-lasalle-green transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script.js (Ruta corregida para archivos en raíz) -->
    <script src="js/script.js" defer></script>
</body>
</html>