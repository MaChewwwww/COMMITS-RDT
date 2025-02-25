@extends('layouts.app-layout')

@section('content')
    <div class="container px-4 mx-auto">
        <div class="flex justify-center">
            <div class="w-full">
                <h1 class="mb-6 text-3xl font-bold text-left mt-14">Dashboard</h1>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Rectangle 1 -->
            <div class="flex items-center p-4 bg-white border rounded-lg shadow-md">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM2 10a8 8 0 1116 0A8 8 0 012 10z" />
                        <path d="M10 4a1 1 0 011 1v4a1 1 0 01-2 0V5a1 1 0 011-1z" />
                        <path d="M10 12a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </div>
                <div class="h-12 mx-4 border-l-2 border-gray-300"></div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Total Student Records</h2>
                    <p class="text-2xl font-bold">100</p>
                </div>
            </div>
            <!-- Rectangle 2 -->
            <div class="flex items-center p-4 bg-white border rounded-lg shadow-md">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM2 10a8 8 0 1116 0A8 8 0 012 10z" />
                        <path d="M10 4a1 1 0 011 1v4a1 1 0 01-2 0V5a1 1 0 011-1z" />
                        <path d="M10 12a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </div>
                <div class="h-12 mx-4 border-l-2 border-gray-300"></div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Total Transactions</h2>
                    <p class="text-2xl font-bold">50</p>
                </div>
            </div>
            <!-- Rectangle 3 -->
            <div class="flex items-center p-4 bg-white border rounded-lg shadow-md">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM2 10a8 8 0 1116 0A8 8 0 012 10z" />
                        <path d="M10 4a1 1 0 011 1v4a1 1 0 01-2 0V5a1 1 0 011-1z" />
                        <path d="M10 12a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </div>
                <div class="h-12 mx-4 border-l-2 border-gray-300"></div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Total Reports</h2>
                    <p class="text-2xl font-bold">30</p>
                </div>
            </div>
            <!-- Rectangle 4 -->
            <div class="flex items-center p-4 bg-white border rounded-lg shadow-md">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM2 10a8 8 0 1116 0A8 8 0 012 10z" />
                        <path d="M10 4a1 1 0 011 1v4a1 1 0 01-2 0V5a1 1 0 011-1z" />
                        <path d="M10 12a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </div>
                <div class="h-12 mx-4 border-l-2 border-gray-300"></div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Total Medicines</h2>
                    <p class="text-2xl font-bold">10</p>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-12">
            <div class="w-full">
                <h2 class="mb-4 text-xl font-bold text-gray-800">Total Patients</h2>
                <div class="p-6 bg-white border rounded-lg shadow-lg">
                    <canvas id="patientsChart" class="w-full h-64 md:h-96 lg:h-128"></canvas>
                </div>
            </div>
        </div>

        <!-- New Section: Types of Patient -->
        <div class="flex justify-center mt-6 md:mt-8">
            <div class="w-full">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Pie Chart Column -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Types of Patient</h2>
                        <div class="relative h-[220px] sm:h-[240px] md:h-[260px] lg:h-[280px] xl:h-[320px]">
                            <canvas id="typesOfPatientChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Patient Distribution Column -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Patient Distribution</h2>
                        <div class="flex flex-col space-y-2">
                            <!-- Students -->
                            <div class="p-2 transition-all duration-300 border rounded-lg bg-blue-50 bg-gradient-to-r from-blue-50 to-white hover:shadow-md hover:border-blue-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-200 rounded-full">
                                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-base font-semibold text-gray-700">Students</h3>
                                            <p class="text-xs text-gray-500">Active Patients</p>
                                        </div>
                                    </div>
                                    <p class="text-xl font-bold text-blue-500">50</p>
                                </div>
                            </div>

                            <!-- Repeat the same pattern for other patient types (Faculty, Dependents, Staff, Visitors) -->
                            <!-- Faculty -->
                            <div class="p-2 transition-all duration-300 border rounded-lg bg-green-50 bg-gradient-to-r from-green-50 to-white hover:shadow-md hover:border-green-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-200 rounded-full">
                                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-base font-semibold text-gray-700">Faculty</h3>
                                            <p class="text-xs text-gray-500">Teaching Staff</p>
                                        </div>
                                    </div>
                                    <p class="text-xl font-bold text-green-500">20</p>
                                </div>
                            </div>

                            <!-- Dependents -->
                            <div class="p-2 transition-all duration-300 border rounded-lg bg-red-50 bg-gradient-to-r from-red-50 to-white hover:shadow-md hover:border-red-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-red-200 rounded-full">
                                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-base font-semibold text-gray-700">Dependents</h3>
                                            <p class="text-xs text-gray-500">Family Members</p>
                                        </div>
                                    </div>
                                    <p class="text-xl font-bold text-red-500">15</p>
                                </div>
                            </div>

                            <!-- Staff -->
                            <div class="p-2 transition-all duration-300 border rounded-lg bg-yellow-50 bg-gradient-to-r from-yellow-50 to-white hover:shadow-md hover:border-yellow-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-yellow-200 rounded-full">
                                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-base font-semibold text-gray-700">Staff</h3>
                                            <p class="text-xs text-gray-500">Support Personnel</p>
                                        </div>
                                    </div>
                                    <p class="text-xl font-bold text-yellow-500">10</p>
                                </div>
                            </div>

                            <!-- Visitors -->
                            <div class="p-2 transition-all duration-300 border rounded-lg bg-purple-50 bg-gradient-to-r from-purple-50 to-white hover:shadow-md hover:border-purple-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-purple-200 rounded-full">
                                            <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-base font-semibold text-gray-700">Visitors</h3>
                                            <p class="text-xs text-gray-500">Guest Patients</p>
                                        </div>
                                    </div>
                                    <p class="text-xl font-bold text-purple-500">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add this before the closing </div> of the container -->
        <div class="flex justify-center mt-6 md:mt-8">
            <div class="w-full">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Left Column: Pie Chart -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Returned Medicines</h2>
                        <div class="relative h-[220px] sm:h-[240px] md:h-[260px] lg:h-[280px] xl:h-[320px]">
                            <canvas id="returnedMedicineChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Right Column: Horizontal Bar Graph -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Top Medicines Consumed</h2>
                        <div class="relative h-[220px] sm:h-[240px] md:h-[260px] lg:h-[280px] xl:h-[320px]">
                            <canvas id="topMedicinesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this after your previous charts section -->
        <div class="flex justify-center mt-6 md:mt-8">
            <div class="w-full">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Left Column: Supplies Pie Chart -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Supplies Status</h2>
                        <div class="relative h-[220px] sm:h-[240px] md:h-[260px] lg:h-[280px] xl:h-[320px]">
                            <canvas id="suppliesChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Right Column: Equipment Vertical Bar Graph -->
                    <div class="p-3 bg-white border rounded-lg shadow-lg md:p-4">
                        <h2 class="mb-2 text-lg font-bold text-gray-800">Equipment Status</h2>
                        <div class="relative h-[220px] sm:h-[240px] md:h-[260px] lg:h-[280px] xl:h-[320px]">
                            <canvas id="equipmentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
    // Add this before creating the charts
    Chart.register(ChartDataLabels);
    Chart.defaults.set('plugins.datalabels', {
        color: '#000000',
        font: {
            weight: 'semibold',
            size: 14
        },
        formatter: function(value, context) {
            return value;
        }
        });
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('patientsChart').getContext('2d');
        var patientsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Total Patients', // This label will be hidden
                    data: [12, 19, 3, 5, 2, 3, 10, 15, 8, 12, 7, 14], // Example data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 18, // Add this line to give bars a curved appearance
                    hoverBackgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    hoverBorderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        barPercentage: 0.5, // Adjust the bar width as a percentage of the category width
                        categoryPercentage: 0.5 // Adjust the category width as a percentage of the available space
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide the legend
                    },
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                return monthNames[tooltipItems[0].dataIndex];
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            callback: function(value, index, values) {
                                var screenWidth = window.innerWidth;
                                var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                var monthAbbreviations = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                return screenWidth < 1268 ? monthAbbreviations[index] : monthNames[index];
                            }
                        }
                    }
                }
            }
        });
        

        // Pie Chart for Types of Patient
        var typesCtx = document.getElementById('typesOfPatientChart').getContext('2d');
        var typesOfPatientChart = new Chart(typesCtx, {
            type: 'pie',
            data: {
                labels: ['Students', 'Faculty', 'Dependents', 'Staff', 'Visitors'],
                datasets: [{
                    data: [50, 20, 15, 10, 5],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',   // Blue for Students - increased opacity
                        'rgba(34, 197, 94, 0.8)',    // Green for Faculty (text-green-500)
                        'rgba(255, 99, 132, 0.8)',    // Red for Dependents
                        'rgba(255, 206, 86, 0.8)',    // Yellow for Staff
                        'rgba(153, 102, 255, 0.8)'    // Purple for Visitors
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(34, 197, 94, 1)',       // Green for Faculty (text-green-500)
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 2, // Increased border width
                    hoverOffset: 15 // Added hover offset
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 5,
                        bottom: 5,
                        left: 5,
                        right: 5
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'center',
                        labels: {
                            padding: 8,
                            boxWidth: 10,
                            font: {
                                size: 10
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    // Add this new datalabels plugin configuration
                    datalabels: {
                        color: '#000000',
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: function(value, context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return percentage + '%';
                        },
                        offset: 0,
                        padding: 0
                    }
                }
            }
        });

    // Returned Medicines Pie Chart
    var returnedMedicineChartCtx = document.getElementById('returnedMedicineChart').getContext('2d');
    var returnedMedicineChart = new Chart(returnedMedicineChartCtx, {
        type: 'pie',
        data: {
            labels: ['Fever', 'Cough', 'Headache', 'Allergies', 'Others'],
            datasets: [{
                data: [30, 25, 20, 15, 10],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 5,
                    bottom: 5,
                    left: 5,
                    right: 5
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'center',
                    labels: {
                        padding: 8,
                        boxWidth: 10,
                        font: {
                            size: 10
                        }
                    }
                },
                datalabels: {
                    color: '#000000',
                    font: {
                        weight: 'bold',
                        size: 10
                    },
                    formatter: function(value, context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return percentage + '%';
                    }
                }
            }
        }
    });

    // Medicines Horizontal Bar Chart
    var topMedicinesChartCtx = document.getElementById('topMedicinesChart').getContext('2d');
    var topMedicinesChart = new Chart(topMedicinesChartCtx, {
        type: 'bar',
        data: {
            labels: ['Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Loratadine', 'Omeprazole'],
            datasets: [{
                axis: 'y',
                data: [65, 59, 40, 35, 28],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(34, 197, 94, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 5,
                    bottom: 5,
                    left: 5,
                    right: 20
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    anchor: 'end',
                    align: 'right',
                    color: '#000000',
                    font: {
                        weight: 'bold',
                        size: 10
                    },
                    formatter: function(value) {
                        return value + ' units';
                    }
                }
            }
        }
    });

    // Supplies Pie Chart
    var suppliesCtx = document.getElementById('suppliesChart').getContext('2d');
    var suppliesChart = new Chart(suppliesCtx, {
        type: 'pie',
        data: {
            labels: ['Initial Quantity', 'Consumed'],
            datasets: [{
                data: [70, 30], // Example data - adjust as needed
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)', // Green for Initial
                    'rgba(239, 68, 68, 0.8)'  // Red for Consumed
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 5,
                    bottom: 5,
                    left: 5,
                    right: 5
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'center',
                    labels: {
                        padding: 8,
                        boxWidth: 10,
                        font: {
                            size: 10
                        }
                    }
                },
                datalabels: {
                    color: '#FFFFFF',
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    formatter: function(value, context) {
                        return value + '%';
                    }
                }
            }
        }
    });

    // Equipment Vertical Bar Chart
    var equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
    var equipmentChart = new Chart(equipmentCtx, {
        type: 'bar',
        data: {
            labels: ['Serviceable', 'For Repair', 'For Condemn', 'Need Replacement'],
            datasets: [{
                data: [45, 20, 15, 10], // Example data - adjust as needed
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',  // Green for Serviceable
                    'rgba(234, 179, 8, 0.8)',   // Yellow for Repair
                    'rgba(239, 68, 68, 0.8)',   // Red for Condemn
                    'rgba(59, 130, 246, 0.8)'   // Blue for Replacement
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(234, 179, 8, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(59, 130, 246, 1)'
                ],
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 5,
                    bottom: 5,
                    left: 5,
                    right: 5
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#000000',
                    font: {
                        weight: 'bold',
                        size: 10
                    },
                    formatter: function(value) {
                        return value + ' units';
                    }
                }
            }
        }
    });
    });
    </script>
@endsection