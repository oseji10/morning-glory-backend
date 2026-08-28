<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\Insight;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Finance & Accounting',
                'slug' => 'finance-accounting',
                'icon' => 'calculator',
                'summary' => 'Management accounts, budgeting, cash flow and financial reporting.',
                'features' => ['Management Accounts', 'Budgeting & Forecasting', 'Cash Flow Management', 'Financial Modelling', 'Financial Reporting', 'CFO Advisory'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Internal Audit & Controls',
                'slug' => 'internal-audit-controls',
                'icon' => 'clipboard-check',
                'summary' => 'Outsourced internal audit, control reviews and fraud risk assessment.',
                'features' => ['Outsourced Internal Audit', 'Internal Control Reviews', 'Audit Planning', 'Process Improvement', 'Fraud Risk Assessment', 'Co-sourcing Support'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Risk & Compliance',
                'slug' => 'risk-compliance',
                'icon' => 'shield-alert',
                'summary' => 'Enterprise risk management, compliance and governance advisory.',
                'features' => ['Enterprise Risk Management', 'Risk Assessments', 'Compliance Reviews', 'Regulatory Compliance', 'Governance Advisory', 'Control Self-Assessment'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Business Advisory',
                'slug' => 'business-advisory',
                'icon' => 'trending-up',
                'summary' => 'Business plans, feasibility studies and performance improvement.',
                'features' => ['Business Plans', 'Feasibility Studies', 'Investment Analysis', 'Business Restructuring', 'Performance Improvement', 'Due Diligence'],
                'sort_order' => 4,
            ],
            [
                'title' => 'Tax & Regulatory Advisory',
                'slug' => 'tax-regulatory-advisory',
                'icon' => 'file-text',
                'summary' => 'Tax reviews, compliance support and regulatory reporting.',
                'features' => ['Tax Reviews', 'Tax Compliance Support', 'Regulatory Reporting', 'VAT & WHT Reviews', 'Tax Planning Advisory'],
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        $caseStudies = [
            [
                'title' => 'Financial Performance Improvement',
                'slug' => 'financial-performance-improvement',
                'summary' => 'Helped a manufacturing business analyse product profitability, pricing, costs and break-even volumes.',
                'industry' => 'Manufacturing',
                'stats' => [
                    ['value' => '₦120M', 'label' => 'COST SAVINGS'],
                    ['value' => '18%', 'label' => 'INCREASE IN GROSS MARGIN'],
                    ['value' => '25%', 'label' => 'REDUCTION IN COSTS'],
                ],
                'published_at' => now(),
            ],
            [
                'title' => 'Internal Control Strengthening',
                'slug' => 'internal-control-strengthening',
                'summary' => 'Designed and implemented internal control framework and audit plan for a financial services firm.',
                'industry' => 'Financial Services',
                'stats' => [
                    ['value' => '90%', 'label' => 'CONTROL EFFECTIVENESS'],
                    ['value' => '70%', 'label' => 'REDUCTION IN AUDIT ISSUES'],
                    ['value' => '100%', 'label' => 'REGULATORY COMPLIANCE'],
                ],
                'published_at' => now(),
            ],
            [
                'title' => 'Cash Flow & Working Capital Optimisation',
                'slug' => 'cash-flow-working-capital-optimisation',
                'summary' => 'Improved cash flow management and reduced receivable days for a trading company.',
                'industry' => 'Trading',
                'stats' => [
                    ['value' => '₦85M', 'label' => 'WORKING CAPITAL RELEASED'],
                    ['value' => '40 DAYS', 'label' => 'REDUCTION IN RECEIVABLE DAYS'],
                    ['value' => '95%', 'label' => 'FORECAST ACCURACY'],
                ],
                'published_at' => now(),
            ],
        ];

        foreach ($caseStudies as $cs) {
            CaseStudy::updateOrCreate(['slug' => $cs['slug']], $cs);
        }

        $insights = [
            ['title' => '10 Financial KPIs Every Business Should Monitor', 'category' => 'FINANCE', 'date' => '2024-05-15'],
            ['title' => 'How to Build an Effective Internal Audit Function', 'category' => 'INTERNAL AUDIT', 'date' => '2024-05-08'],
            ['title' => 'Top 5 Business Risks to Watch in 2024', 'category' => 'RISK MANAGEMENT', 'date' => '2024-04-30'],
            ['title' => 'Understanding VAT Compliance Requirements', 'category' => 'TAX', 'date' => '2024-04-22'],
            ['title' => 'How to Prepare a Bankable Business Plan', 'category' => 'BUSINESS ADVISORY', 'date' => '2024-04-15'],
        ];

        foreach ($insights as $post) {
            $slug = \Illuminate\Support\Str::slug($post['title']);
            Insight::updateOrCreate(['slug' => $slug], [
                'title' => $post['title'],
                'category' => $post['category'],
                'excerpt' => $post['title'],
                'published_at' => $post['date'],
            ]);
        }
    }
}
